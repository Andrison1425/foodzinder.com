<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
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

            $plato['id'] = $plato_id;

            return redirect()->route('categorias.index', ['id' => $request->input('restauranteId')])->with('Notificacion','Plato agregado');
        }
    }

    // START ENTRANTES
    public function AddNewProductoEntrante(Request $request)
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
            $tmpFile->move(public_path().'/images/categorias/entrantes/', $name);
            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/entrantes/'.$name;

            $entrante_id = DB::table('entrantes')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }

        if ($request->file('file')) {
            // Esto es una imagen de tipo file
            $file = $request->file('file'); // capturo el archivo
            $name = time().$request->input('restauranteId').$file->getClientOriginalName(); // le pongo imagen al archivo

            // Guardo la imagen en la siguiente carpeta
            $file->move(public_path().'/images/categorias/entrantes/', $name);

            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/entrantes/'.$name;

            $entrante_id = DB::table('entrantes')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }
    }

    public function eliminarEntrante($id)
    {
        DB::table('entrantes')->where('id', $id)->delete();
        return response()->json([
            $id => 'Fue borrado exitosamente'
        ]);
    }

    public function editarEntrante(Request $request)
    {
        $producto = $request->input('producto');
        $data['nombre'] = $producto['nombre'];
        $data['precio'] = $producto['precio'];

        DB::table($producto['nombre_de_la_tabla_db'])->where('id', $producto['id'])->update($data);
        return $producto;
    }

    public function cambiarStatus($id, $nombre)
    {
        $categoria = DB::table($nombre)->where('id', $id)->first();

        $actualizacion = $categoria->status == "1" ? ['status' => 2] : ['status' => 1];

        DB::table($nombre)->where('id', $id)->update($actualizacion);

        return response()->json([
            $actualizacion,
            "categoria" => $nombre,
            "categoria_id" => $id
        ]);
    }
    // END ENTRANTES

    // START SOPA
    public function AddNewProductoSopa(Request $request)
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
            $tmpFile->move(public_path().'/images/categorias/sopas/', $name);
            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/sopas/'.$name;

            $entrante_id = DB::table('sopas')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }

        $file = $request->file('file'); // capturo el archivo
        $name = time().$request->input('restauranteId').$file->getClientOriginalName(); // le pongo imagen al archivo

        // Guardo la imagen en la siguiente carpeta
        $file->move(public_path().'/images/categorias/sopas/', $name);

        // Preparamos el producto:
        $sopa['nombre'] = $request->input('nombre');
        $sopa['precio'] = $request->input('precio');
        $sopa['restaurant_id'] = $request->input('restauranteId');
        $sopa['imagen'] = '/images/categorias/sopas/'.$name;

        $sopa_id = DB::table('sopas')->insertGetId($sopa);

        $sopa['id'] = $sopa_id;

        return response()->json($sopa);
    }
    public function eliminarSopa($id)
    {
        DB::table('sopas')->where('id', $id)->delete();
        return response()->json([
            $id => 'Fue borrado exitosamente'
        ]);
    }
    // END SOPA

    // START FRITO
    public function AddNewProductoFrito(Request $request)
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
            $tmpFile->move(public_path().'/images/categorias/fritos/', $name);
            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/fritos/'.$name;

            $entrante_id = DB::table('fritos')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }

        $file = $request->file('file'); // capturo el archivo
        $name = time().$request->input('restauranteId').$file->getClientOriginalName(); // le pongo imagen al archivo

        // Guardo la imagen en la siguiente carpeta
        $file->move(public_path().'/images/categorias/fritos/', $name);

        // Preparamos el producto:
        $frito['nombre'] = $request->input('nombre');
        $frito['precio'] = $request->input('precio');
        $frito['restaurant_id'] = $request->input('restauranteId');
        $frito['imagen'] = '/images/categorias/fritos/'.$name;

        $frito_id = DB::table('fritos')->insertGetId($frito);

        $frito['id'] = $frito_id;

        return response()->json($frito);
    }

    public function eliminarFrito($id)
    {
        DB::table('fritos')->where('id', $id)->delete();
        return response()->json([
            $id => 'Fue borrado exitosamente'
        ]);
    }
    // END FRITO

    // START CARNE
    public function AddNewProductoCarne(Request $request)
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
            $tmpFile->move(public_path().'/images/categorias/carnes/', $name);
            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/carnes/'.$name;

            $entrante_id = DB::table('carnes')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }

        $file = $request->file('file'); // capturo el archivo
        $name = time().$request->input('restauranteId').$file->getClientOriginalName(); // le pongo imagen al archivo

        // Guardo la imagen en la siguiente carpeta
        $file->move(public_path().'/images/categorias/carnes/', $name);

        // Preparamos el producto:
        $carne['nombre'] = $request->input('nombre');
        $carne['precio'] = $request->input('precio');
        $carne['restaurant_id'] = $request->input('restauranteId');
        $carne['imagen'] = '/images/categorias/carnes/'.$name;

        $carne_id = DB::table('carnes')->insertGetId($carne);

        $carne['id'] = $carne_id;

        return response()->json($carne);
    }

    public function eliminarCarne($id)
    {
        DB::table('carnes')->where('id', $id)->delete();
        return response()->json([
            $id => 'Fue borrado exitosamente'
        ]);
    }
    // END CARNE

    // START PESCADO
    public function AddNewProductoPescado(Request $request)
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
            $tmpFile->move(public_path().'/images/categorias/pescados/', $name);
            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/pescados/'.$name;

            $entrante_id = DB::table('pescados')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }

        $file = $request->file('file'); // capturo el archivo
        $name = time().$request->input('restauranteId').$file->getClientOriginalName(); // le pongo imagen al archivo

        // Guardo la imagen en la siguiente carpeta
        $file->move(public_path().'/images/categorias/pescados/', $name);

        // Preparamos el producto:
        $pescado['nombre'] = $request->input('nombre');
        $pescado['precio'] = $request->input('precio');
        $pescado['restaurant_id'] = $request->input('restauranteId');
        $pescado['imagen'] = '/images/categorias/pescados/'.$name;

        $pescado_id = DB::table('pescados')->insertGetId($pescado);

        $pescado['id'] = $pescado_id;

        return response()->json($pescado);
    }

    public function eliminarPescado($id)
    {
        DB::table('pescados')->where('id', $id)->delete();
        return response()->json([
            $id => 'Fue borrado exitosamente'
        ]);
    }
    // END PESCADO

    // START PASTA
    public function AddNewProductoPasta(Request $request)
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
            $tmpFile->move(public_path().'/images/categorias/pastas/', $name);
            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/pastas/'.$name;

            $entrante_id = DB::table('pastas')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }

        $file = $request->file('file'); // capturo el archivo
        $name = time().$request->input('restauranteId').$file->getClientOriginalName(); // le pongo imagen al archivo

        // Guardo la imagen en la siguiente carpeta
        $file->move(public_path().'/images/categorias/pastas/', $name);

        // Preparamos el producto:
        $pasta['nombre'] = $request->input('nombre');
        $pasta['precio'] = $request->input('precio');
        $pasta['restaurant_id'] = $request->input('restauranteId');
        $pasta['imagen'] = '/images/categorias/pastas/'.$name;

        $pasta_id = DB::table('pastas')->insertGetId($pasta);

        $pasta['id'] = $pasta_id;

        return response()->json($pasta);
    }

    public function eliminarPasta($id)
    {
        DB::table('pastas')->where('id', $id)->delete();
        return response()->json([
            $id => 'Fue borrado exitosamente'
        ]);
    }
    // END PASTA

    // START POSTRE
    public function AddNewProductoPostre(Request $request)
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
            $tmpFile->move(public_path().'/images/categorias/postres/', $name);
            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/postres/'.$name;

            $entrante_id = DB::table('postres')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }

        $file = $request->file('file'); // capturo el archivo
        $name = time().$request->input('restauranteId').$file->getClientOriginalName(); // le pongo imagen al archivo

        // Guardo la imagen en la siguiente carpeta
        $file->move(public_path().'/images/categorias/postres/', $name);

        // Preparamos el producto:
        $postre['nombre'] = $request->input('nombre');
        $postre['precio'] = $request->input('precio');
        $postre['restaurant_id'] = $request->input('restauranteId');
        $postre['imagen'] = '/images/categorias/postres/'.$name;

        $postre_id = DB::table('postres')->insertGetId($postre);

        $postre['id'] = $postre_id;

        return response()->json($postre);
    }

    public function eliminarPostre($id)
    {
        DB::table('postres')->where('id', $id)->delete();
        return response()->json([
            $id => 'Fue borrado exitosamente'
        ]);
    }
    // END POSTRE

    // START BEBIDAS
    public function AddNewProductoBebida(Request $request)
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
            $tmpFile->move(public_path().'/images/categorias/bebidas/', $name);
            // Preparamos el producto:
            $entrante['nombre'] = $request->input('nombre');
            $entrante['precio'] = $request->input('precio');
            $entrante['restaurant_id'] = $request->input('restauranteId');
            $entrante['imagen'] = '/images/categorias/bebidas/'.$name;

            $entrante_id = DB::table('bebidas')->insertGetId($entrante);

            $entrante['id'] = $entrante_id;

            return response()->json($entrante);
        }

        $file = $request->file('file'); // capturo el archivo
        $name = time().$request->input('restauranteId').$file->getClientOriginalName(); // le pongo imagen al archivo

        // Guardo la imagen en la siguiente carpeta
        $file->move(public_path().'/images/categorias/bebidas/', $name);

        // Preparamos el producto:
        $bebida['nombre'] = $request->input('nombre');
        $bebida['precio'] = $request->input('precio');
        $bebida['restaurant_id'] = $request->input('restauranteId');
        $bebida['imagen'] = '/images/categorias/bebidas/'.$name;

        $bebida_id = DB::table('bebidas')->insertGetId($bebida);

        $bebida['id'] = $bebida_id;

        return response()->json($bebida);
    }

    public function eliminarBebida($id)
    {
        DB::table('bebidas')->where('id', $id)->delete();
        return response()->json([
            $id => 'Fue borrado exitosamente'
        ]);
    }
    // END BEBIDAS
}
