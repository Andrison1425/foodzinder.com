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
        // ["1", "0", "2", "3", "4"]
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

            $name = $tmpFile->getFilename().'.png';
            $tmpFile->move(public_path().'/images/platos/', $name);
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

        if (!$imagen) {

            $plato->update([
                'nombre' => $nombre,
                'precio'=>$precio,
                'descripcion'=>$descripcion
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

             $name = $tmpFile->getFilename().'.png';
             $tmpFile->move(public_path().'/images/platos/', $name);

             $imagen='/images/platos/'.$name;

             unlink(public_path().$plato->imagen);

             $plato->update([
                'nombre' => $nombre,
                'precio'=>$precio,
                'imagen'=>$imagen,
                'descripcion'=>$descripcion
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
