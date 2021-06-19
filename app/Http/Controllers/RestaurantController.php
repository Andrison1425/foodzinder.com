<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;
use App\User;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('restaurant.index');
    }

    function formatear($cadena){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores

        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        $cadena=str_replace(' ', '-', $cadena);
        $cadena=str_replace("'", '', $cadena);
        $cadena=strtolower($cadena);

        return $cadena;
    }

    public function listado()
    {
        $restaurantes = Restaurant::get();
        $admin = User::where('email', '=' , "admin@admin.com")->get();
        foreach ($admin as $key => $value) {
            $admin=$value;
        }

        foreach($restaurantes as $restaurante){
            if(is_int($restaurante)){
                continue;
            }else{
                $restaurante['nombreUrl']=$this->formatear($restaurante->nombre);
                $arrRestaurantes[$restaurante->id]=$restaurante;
            }
        }

        $prioridad=json_decode($admin->prioridad);
        return view('restaurant.listado', ['restaurantes' => $restaurantes,'prioridad'=>$prioridad]);
    }


    public function create(){
        return view("restaurant.create");
    }

    public function comprimir($ruta){
        //Compress Image Code Here
        $filepath = $ruta;
        try {
            \Tinify\setKey(env("Z8WHnRhMQhWzYhfb7qTqLwLqr8RTkZnZ"));
            $source = \Tinify\fromFile($filepath);
            $source->toFile($filepath);
        } catch(\Tinify\AccountException $e) {
            // Verify your API key and account limit.
            return redirect()->route('restaurant.create')->with('Notificacion','Ha ocurrido un error en la carga de la imagen');
        } catch(\Tinify\ClientException $e) {
            // Check your source image and request options.
            return redirect()->route('restaurant.create')->with('Notificacion','Ha ocurrido un error en la carga de la imagen');
        } catch(\Tinify\ServerException $e) {
            // Temporary issue with the Tinify API.
            return redirect()->route('restaurant.create')->with('Notificacion','Ha ocurrido un error en la carga de la imagen');
        } catch(\Tinify\ConnectionException $e) {
            // A network connection error occurred.
            return redirect()->route('restaurant.create')->with('Notificacion','Ha ocurrido un error en la carga de la imagen');
        }
    }

    public function store(Request $request)
    {
        // Crear y guardar el Restaurant con los datos validados:
        $request["categorias"]=!empty($request->input("categorias")) ? $request->input("categorias") : "[]";

        // Guardamos las imagenes que vienen como ARCHIVO
        if($request->hasfile('filenames')){
            $arrImg=json_decode($request->file('filenames'), true);
            foreach($request->file('filenames') as $pos => $file)
            {
                $name = $pos.time().'.'.$file->extension();
                $file->move(public_path().'/images/restaurantes/', $name);
                $data[] = '/images/restaurantes/'.$name;
            }
            $file = $request->file('filenames');
            $name = time().'.'.$file->extension();
            $file->move(public_path().'/images/restaurantes/', $name);
            $request['imagenes'] = '/images/restaurantes/'.$name;
            unset($request['filenames']);
        } else if ($request->input('filenames')) {
            $arrImg=json_decode($request->input('filenames'), true);
            $arrNamesImgs=[];

            foreach($arrImg as $pos=>$img)
            {
                // Esto es una imagen de tipo base 64
                $base64File = $img;

                // decode the base64 file
                $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

                // save it to temporary dir first.
                $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
                file_put_contents($tmpFilePath, $fileData);

                // this just to help us get file info.
                $tmpFile = new File($tmpFilePath);

                //get file extension
                $extension = $tmpFile->getMimeType();

                if($extension=='image/png'){
                    $extension='.jpg';
                }else{
                    $extension='.jpg';
                }
                $name = $tmpFile->getFilename().$extension;

                $tmpFile->move(public_path().'/images/restaurantes/', $name);
                $this->comprimir(public_path().'/images/restaurantes/'.$name);
                $arrNamesImgs[] = '/images/restaurantes/'.$name;
            }

            $request['imagenes'] = json_encode($arrNamesImgs) ;
            unset($request['filenames']);
            unset($request['filenames2']);
        }
        if($request->input('filenames2')){

            // Esto es una imagen de tipo base 64
            $base64File = $request->input('filenames2');

            // decode the base64 file
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

            // save it to temporary dir first.
            $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
            file_put_contents($tmpFilePath, $fileData);

            // this just to help us get file info.
            $tmpFile = new File($tmpFilePath);

            //get file extension
            $extension = $tmpFile->getMimeType();

            if($extension=='image/png'){
                $extension='.jpg';
            }else{
                $extension='.jpg';
            }
            $name = $tmpFile->getFilename().$extension;

            $tmpFile->move(public_path().'/images/restaurantes/', $name);
            $this->comprimir(public_path().'/images/restaurantes/'.$name);

            $request['imgMin'] = '/images/restaurantes/'.$name;
        }
        $restaurant=Restaurant::create($request->all());

        return redirect(route('categorias.index', ["id" => $restaurant->id]))->with('Notificacion', 'Restaurante creado exitosamente');
    }

    public function show($id)
    {
        return view('restaurant.show', ['restaurant' => Restaurant::findOrFail($id)]);
    }

    public function edit($id)
    {
        $restaurant = Restaurant::find($id);

        return view("restaurant.edit", ['restaurant' => $restaurant]);
    }

    public function update($id, Request $request)
    {
        $restaurant = Restaurant::find($id);
        $imagenes=json_decode($request->input("imagenes"), true);

        $arrNamesImgs=$imagenes;

        if ($request->input('filenames')){
            $arrImg=json_decode($request->input('filenames'), true);

            foreach($arrImg as $pos=>$img)
            {
                // Esto es una imagen de tipo base 64
                $base64File = $img;

                // decode the base64 file
                $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

                // save it to temporary dir first.
                $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
                file_put_contents($tmpFilePath, $fileData);

                // this just to help us get file info.
                $tmpFile = new File($tmpFilePath);

                //get file extension
                $extension = $tmpFile->getMimeType();

                if($extension=='image/png'){
                    $extension='.jpg';
                }else{
                    $extension='.jpg';
                }
                $name = $tmpFile->getFilename().$extension;

                $tmpFile->move(public_path().'/images/restaurantes/', $name);
                $this->comprimir(public_path().'/images/restaurantes/'.$name);
                $arrNamesImgs[] = '/images/restaurantes/'.$name;
            }
        }

        $request['imagenes']=json_encode($arrNamesImgs);

        if($request->input('filenames2')){

            // Esto es una imagen de tipo base 64
            $base64File = $request->input('filenames2');

            // decode the base64 file
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

            // save it to temporary dir first.
            $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
            file_put_contents($tmpFilePath, $fileData);

            // this just to help us get file info.
            $tmpFile = new File($tmpFilePath);

            //get file extension
            $extension = $tmpFile->getMimeType();

            if($extension=='image/png'){
                $extension='.jpg';
            }else{
                $extension='.jpg';
            }
            $name = $tmpFile->getFilename().$extension;

            $tmpFile->move(public_path().'/images/restaurantes/', $name);
            $this->comprimir(public_path().'/images/restaurantes/'.$name);

            $request['imgMin'] = '/images/restaurantes/'.$name;
        }

        unset($request["filenames"]);
        unset($request["filenames2"]);
        unset($request["submit"]);
        $restaurant->update($request->all());

        $restaurantes = Restaurant::get();
        $admin = User::where('email', '=' , "admin@admin.com")->get();
        foreach ($admin as $key => $value) {
            $admin=$value;
        }

        foreach($restaurantes as $restaurante){
            if(is_int($restaurante)){
                continue;
            }else{
                $restaurante['nombreUrl']=$this->formatear($restaurante->nombre);
                $arrRestaurantes[$restaurante->id]=$restaurante;
            }
        }

        $prioridad=json_decode($admin->prioridad);
        return view('restaurant.listado', ['restaurantes' => $restaurantes,'prioridad'=>$prioridad])->with('Notificacion', 'Restaurante editado exitosamente');

    }

    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->platos()->delete();
        $restaurant->delete();
        return redirect()->route('restaurant.index')->with('Notificacion', 'Restaurante borrado exitosamente');
    }

    public function get_ciudad($number)
    {
        $nombre = "";
        switch ($number) {
            case '1':
                $nombre = "Madrid";
            break;
            case '2':
                $nombre = "Barcelona";
            break;
            case '3':
                $nombre = "Tarifa";
            break;
        }
        return $nombre;
    }

    public function cambiarStatus($id)
    {
        $restaurant = Restaurant::find($id);

        if ($restaurant->status === "1") {
            $restaurant->status = "2";
        } else {
            $restaurant->status = "1";
        }
        $restaurant->update();
        return redirect()->back();
    }

    public function organizarImgs(Request $request, $restauranteId)
    {
        $restaurante = Restaurant::findOrFail($restauranteId);

        $posiciones=$request->input('valueImgOrden');
        if($posiciones=="[]"){
            $posiciones="[0]";
        }

        $restaurante->update([
            'img_orden'=>$posiciones
        ]);

        return redirect()->route('categorias.index', ['id' => $restauranteId])->with('Notificacion','Las imágenes se han organizado');
    }

    public function listadoPrioridad()
    {
        $admin = User::where('email', '=' , "admin@admin.com")->get();
        foreach ($admin as $key => $value) {
            $admin=$value;
        }
        $prioridad=json_decode($admin->prioridad);

        $restaurantes = Restaurant::where('status', 1)->get();

        $arrRestaurantes=[];
        foreach($restaurantes as $restaurante){
            if(is_int($restaurante)){
                continue;
            }else{
                $restaurante['nombreUrl']=$this->formatear($restaurante->nombre);
                $arrRestaurantes[$restaurante->id]=$restaurante;
            }
        }

        if($prioridad){
            $array_ordenado = array_replace( array_flip( $prioridad ), $arrRestaurantes );
            $restaurantes=$array_ordenado;
        }

        return view('restaurant.listadoAprobar',["restaurantes"=>$restaurantes]);
    }

    public function priorizar($restauranteId)
    {
        $admin = User::where('email', '=' , "admin@admin.com")->get();
        foreach ($admin as $key => $value) {
            $admin=$value;
        }
        $prioridad=json_decode($admin->prioridad);
        $prioridad[]=$restauranteId;

        $admin->update([
            'prioridad'=>json_encode($prioridad)
        ]);

        return redirect()->route('restaurant.listado')->with("Notificacion','La prioridad del restaurante de ID $restauranteId ha cambiado");
    }

    public function cambiarPrioridad(Request $request)
    {
        $admin = User::where('email', '=' , "admin@admin.com")->get();
        foreach ($admin as $key => $value) {
            $admin=$value;
        }

        $admin->update([
            'prioridad'=>$request->prioridad
        ]);

        return redirect()->route('restaurant.listadoPrioridad')->with("Notificacion','La prioridad de los restaurantes ha cambiado");
    }

    public function quitarPrioridad($restauranteId)
    {
        $admin = User::where('email', '=' , "admin@admin.com")->get();
        foreach ($admin as $key => $value) {
            $admin=$value;
        }
        $prioridad=json_decode($admin->prioridad);

        foreach ($prioridad as $key => $value) {
            if($value==$restauranteId){
                unset($prioridad[$key]);
            }
        }
        $arr=[];

        foreach ($prioridad as $key => $value) {
            $arr[]=$value;
        }

        $admin->update([
            'prioridad'=>json_encode($arr)
        ]);

        return redirect()->route('restaurant.listadoPrioridad')->with("Notificacion','Se ha quitado la prioridad al restaurante de ID $restauranteId");
    }
}
