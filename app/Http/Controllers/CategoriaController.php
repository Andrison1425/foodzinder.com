<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Plato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;

class CategoriaController extends Controller
{
    public function index($id)
    {
        $restaurante = Restaurant::find($id);
        $restaurante->categorias=json_decode($restaurante->categorias,true);
        $platos = $restaurante->platos;
        $arrPlatos=[];
        $i=0;

        foreach($platos as $plato){
            $plato->pos=$i;
            $arrPlatos[]=$plato;
            $i++;
        }

        $orden = json_decode($restaurante->posiciones);
        if($orden && $arrPlatos){
            $array_ordenado = array_replace( array_flip( $orden ), $arrPlatos );
            $platos=$array_ordenado;
        }
        return view("categorias.index", [
            'restaurante' => $restaurante,
            'platos'=>$platos
        ]);
    }

    public function agregarCategoria(Request $request){
        $restaurante = Restaurant::find($request->id);
        if($restaurante->categorias){
            $categorias=json_decode($restaurante->categorias,true);
            $categorias[]=$request->categoria;
            $restaurante->categorias=json_encode($categorias);

        }else{
            $restaurante->categorias=json_encode([$request->categoria]);
        }

        $restaurante->save();
        return redirect()->route('categorias.index', ['id' => $request->id])->with('Notificacion','Categoría agregada');
    }

    public function comprimir($ruta){
        //Compress Image Code Here
        $filepath = $ruta;

        try{
            \Tinify\setKey(env("TINIFY_API_KEY"));
            $source = \Tinify\fromFile($filepath);
            $source->toFile($filepath);
            dd("entró");
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
        }catch(\Exception $e) {
            dd("Error linea 76");
            // Something else went wrong, unrelated to the Tinify API.
            //return redirect('ROUTE_HERE')->with('error', $e->getMessage());
        }
    }

    public function agregarProducto(Request $request)
    {
        if ($request->input('file')) {
            // Esto es una imagen de tipo base 64
            $base64File = $request->input('file');

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
                $extension='.png';
            }else{
                $extension='.jpg';
            }
            $name = $tmpFile->getFilename().$extension;
            $tmpFile->move(public_path().'/images/platos/', $name);

            $this->comprimir(public_path().'/images/platos/'.$name);

            // Preparamos el producto:
            $plato['nombre'] = $request->input('nombre');
            $plato['precio'] = $request->input('precio');
            $plato['descripcion'] = $request->input('descripcion');
            $plato['alergenos'] = $request->input('alergenos');
            $plato['restaurant_id'] = $request->input('restauranteId');
            $plato['categoria'] = $request->input('categoria');
            $plato['imagen'] = '/images/platos/'.$name;

            $plato_id = DB::table('platos')->insertGetId($plato);

            $plato['posicion'] = $plato_id;
            $plato['id'] = $plato_id;

            return redirect()->route('categorias.index', ['id' => $request->input('restauranteId')])->with('Notificacion','Plato agregado');
        }
    }

    public function eliminarProducto($id,$restauranteId)
    {
        $plato = Plato::findOrFail($id)->delete();
        return redirect()->route('categorias.index', ['id' => $restauranteId])->with('Notificacion','Plato eliminado');
    }

    public function editarProducto(Request $request)
    {
        $plato = Plato::findOrFail($request->id);
        $nombre = $request->input('nombre');
        $precio= $request->input('precio');
        $descripcion= $request->input('descripcion');
        $imagen=$request->input('file');
        $alergenos=$request->input('alergenos');

        if (!$imagen) {
            $plato->update([
                'nombre' => $nombre,
                'precio'=>$precio,
                'descripcion'=>$descripcion,
                'alergenos'=>$alergenos
            ]);

            return redirect()->route('categorias.index', ['id' => $request->input('restauranteId')])->with('Notificacion','Plato editado');

        }else{

            // Esto es una imagen de tipo base 64
            $base64File = $request->input('file');

            // decode the base64 file
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

            // save it to temporary dir first.
            $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
            file_put_contents($tmpFilePath, $fileData);

             // this just to help us get file info.
             $tmpFile = new File($tmpFilePath);

             $extension = $tmpFile->getMimeType();

             if($extension=='image/png'){
                $extension='.png';
             }else{
                $extension='.jpg';
             }
             $name = $tmpFile->getFilename().$extension;

             $tmpFile->move(public_path().'/images/platos/', $name);

             $this->comprimir(public_path().'/images/platos/'.$name);

             $imagen='/images/platos/'.$name;

             unlink(public_path().$plato->imagen);

             $plato->update([
                'nombre' => $nombre,
                'precio'=>$precio,
                'imagen'=>$imagen,
                'descripcion'=>$descripcion,
                'alergenos'=>$alergenos
            ]);
            return redirect()->route('categorias.index', ['id' => $request->input('restauranteId')])->with('Notificacion','Plato editado');
        }
    }

    public function cambiarStatus($id)
    {
        $plato =  Plato::findOrFail($id);
        $actualizacion = $plato->status == "1" ? ['status' => 2] : ['status' => 1];
        $plato->update($actualizacion);
        return response()->json( $actualizacion);
    }

    public function cambiarCategoria($id, $categoria, $restauranteId)
    {
        $plato = Plato::findOrFail($id);
        $plato->update([
            'categoria'=>$categoria
        ]);
        return redirect()->route('categorias.index', ['id' => $restauranteId])->with('Notificacion','El plato ha cambiado de categoría');

    }

    public function organizarPlatos(Request $request, $restauranteId)
    {
        $restaurante = Restaurant::findOrFail($restauranteId);

        $posiciones=$request->input('posiciones');

        $restaurante->update([
            'posiciones'=>$posiciones
        ]);

        return redirect()->route('categorias.index', ['id' => $restauranteId])->with('Notificacion','Los platos se han organizado');
    }

    public function editarCategorias(Request $request,$restauranteId)
    {
        $restaurante = Restaurant::findOrFail($restauranteId);

        $restaurante->update([
            'categorias'=>$request['categorias']
        ]);
        return redirect()->route('categorias.index', ['id' => $restauranteId])->with('Notificacion','Nombre de categorías ha sido editado con éxito');
    }
}
