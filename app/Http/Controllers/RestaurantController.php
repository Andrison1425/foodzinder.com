<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class RestaurantController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $restaurantes = Restaurant::get();
        return view("restaurant.create", ['restaurantes' => $restaurantes]);
    }

    public function store(Request $request)
    {
        // Crear y guardar el Restaurant con los datos validados:
        $restaurant = new Restaurant;
        $restaurant->nombre = !empty($request->input("nombre")) ? $request->input("nombre") : null;
        $restaurant->direccion = !empty($request->input("direccion")) ? $request->input("direccion") : null;
        $restaurant->ciudad = !empty($request->input("ciudad")) ? $request->input("ciudad") : null;
        $restaurant->pais = !empty($request->input("pais")) ? $request->input("pais") : null;
        $restaurant->telefono = !empty($request->input("telefono")) ? $request->input("telefono") : null;
        $restaurant->google_maps = !empty($request->input("google_maps")) ? $request->input("google_maps") : null;
        $restaurant->correo = !empty($request->input("correo")) ? $request->input("correo") : null;

        $restaurant->precio1 = !empty($request->input("precio1")) ? $request->input("precio1") : null;
        $restaurant->precio2 = !empty($request->input("precio2")) ? $request->input("precio2") : null;
        $restaurant->precio3 = !empty($request->input("precio3")) ? $request->input("precio3") : null;
        $restaurant->restaurante = !empty($request->input("restaurante")) ? $request->input("restaurante") : null;
        $restaurant->cafeteria = !empty($request->input("cafeteria")) ? $request->input("cafeteria") : null;
        $restaurant->bar = !empty($request->input("bar")) ? $request->input("bar") : null;
        $restaurant->admite_reservas = !empty($request->input("admite_reservas")) ? $request->input("admite_reservas") : null;
        $restaurant->para_llevar = !empty($request->input("para_llevar")) ? $request->input("para_llevar") : null;
        $restaurant->domicilio = !empty($request->input("domicilio")) ? $request->input("domicilio") : null;
        $restaurant->terraza_exterior = !empty($request->input("terraza_exterior")) ? $request->input("terraza_exterior") : null;
        $restaurant->wifi_gratuito = !empty($request->input("wifi_gratuito")) ? $request->input("wifi_gratuito") : null;
        $restaurant->sin_gluten = !empty($request->input("sin_gluten")) ? $request->input("sin_gluten") : null;
        $restaurant->accesible = !empty($request->input("accesible")) ? $request->input("accesible") : null;
        $restaurant->admite_mascotas = !empty($request->input("admite_mascotas")) ? $request->input("admite_mascotas") : null;
        $restaurant->plastic_free = !empty($request->input("plastic_free")) ? $request->input("plastic_free") : null;
        $restaurant->desayuno = !empty($request->input("desayuno")) ? $request->input("desayuno") : null;
        $restaurant->brunch = !empty($request->input("brunch")) ? $request->input("brunch") : null;
        $restaurant->almuerzo = !empty($request->input("almuerzo")) ? $request->input("almuerzo") : null;
        $restaurant->merienda = !empty($request->input("merienda")) ? $request->input("merienda") : null;
        $restaurant->cena = !empty($request->input("cena")) ? $request->input("cena") : null;
        $restaurant->dulce = !empty($request->input("dulce")) ? $request->input("dulce") : null;
        $restaurant->salado = !empty($request->input("salado")) ? $request->input("salado") : null;
        $restaurant->local = !empty($request->input("local")) ? $request->input("local") : null;
        $restaurant->nacional = !empty($request->input("nacional")) ? $request->input("nacional") : null;
        $restaurant->internacional = !empty($request->input("internacional")) ? $request->input("internacional") : null;
        $restaurant->fusion = !empty($request->input("fusion")) ? $request->input("fusion") : null;
        $restaurant->vegetariano = !empty($request->input("vegetariano")) ? $request->input("vegetariano") : null;
        $restaurant->vegano = !empty($request->input("vegano")) ? $request->input("vegano") : null;
        $restaurant->marisco = !empty($request->input("marisco")) ? $request->input("marisco") : null;
        $restaurant->atun = !empty($request->input("atun")) ? $request->input("atun") : null;
        $restaurant->sushi = !empty($request->input("sushi")) ? $request->input("sushi") : null;
        $restaurant->pescado = !empty($request->input("pescado")) ? $request->input("pescado") : null;
        $restaurant->carne = !empty($request->input("carne")) ? $request->input("carne") : null;
        $restaurant->paella = !empty($request->input("paella")) ? $request->input("paella") : null;
        $restaurant->pasta = !empty($request->input("pasta")) ? $request->input("pasta") : null;
        $restaurant->pizza = !empty($request->input("pizza")) ? $request->input("pizza") : null;
        $restaurant->zumos_y_batidos = !empty($request->input("zumos_y_batidos")) ? $request->input("zumos_y_batidos") : null;

        // Guardamos las imagenes que vienen como ARCHIVO
        if($request->hasfile('filenames'))
        {
        //    foreach($request->file('filenames') as $pos => $file)
        //    {
        //        $name = $pos.time().'.'.$file->extension();
        //        $file->move(public_path().'/images/restaurantes/', $name);
        //        $data[] = '/images/restaurantes/'.$name;
        //    }
            $file = $request->file('filenames');
            $name = time().'.'.$file->extension();
            $file->move(public_path().'/images/restaurantes/', $name);
            $restaurant->imagenes = '/images/restaurantes/'.$name;
        } else if ($request->input('filenames')) {
            // Esto es una imagen de tipo base 64
            $base64File = $request->input('filenames');

            // decode the base64 file
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

            // save it to temporary dir first.
            $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
            file_put_contents($tmpFilePath, $fileData);

            // this just to help us get file info.
            $tmpFile = new File($tmpFilePath);

            $name = $tmpFile->getFilename().'.png';
            $tmpFile->move(public_path().'/images/restaurantes/', $name);
            $restaurant->imagenes = '/images/restaurantes/'.$name;
        }
        $restaurant->tiene_whatsapp = !empty($request->input('tiene_whatsapp')) ? 1 : 0;
        $restaurant->horario = !empty($request->input("horario")) ? $request->input("horario") : null;

        $restaurant->save();

        return redirect(route('restaurant.show', ["id" => $restaurant->id]))->with('notification', 'Restaurante creado exitosamente');

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

    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant = Restaurant::find($request->id);

        $restaurant->nombre = !empty($request->input("nombre")) ? $request->input("nombre") : null;
        $restaurant->direccion = !empty($request->input("direccion")) ? $request->input("direccion") : null;
        $restaurant->ciudad = !empty($request->input("ciudad")) ? $request->input("ciudad") : null;
        $restaurant->pais = !empty($request->input("pais")) ? $request->input("pais") : null;
        $restaurant->telefono = !empty($request->input("telefono")) ? $request->input("telefono") : null;
        $restaurant->google_maps = !empty($request->input("google_maps")) ? $request->input("google_maps") : null;

        $restaurant->precio1 = !empty($request->input("precio1")) ? $request->input("precio1") : null;
        $restaurant->precio2 = !empty($request->input("precio2")) ? $request->input("precio2") : null;
        $restaurant->precio3 = !empty($request->input("precio3")) ? $request->input("precio3") : null;
        $restaurant->restaurante = !empty($request->input("restaurante")) ? $request->input("restaurante") : null;
        $restaurant->cafeteria = !empty($request->input("cafeteria")) ? $request->input("cafeteria") : null;
        $restaurant->bar = !empty($request->input("bar")) ? $request->input("bar") : null;
        $restaurant->admite_reservas = !empty($request->input("admite_reservas")) ? $request->input("admite_reservas") : null;
        $restaurant->para_llevar = !empty($request->input("para_llevar")) ? $request->input("para_llevar") : null;
        $restaurant->domicilio = !empty($request->input("domicilio")) ? $request->input("domicilio") : null;
        $restaurant->terraza_exterior = !empty($request->input("terraza_exterior")) ? $request->input("terraza_exterior") : null;
        $restaurant->wifi_gratuito = !empty($request->input("wifi_gratuito")) ? $request->input("wifi_gratuito") : null;
        $restaurant->sin_gluten = !empty($request->input("sin_gluten")) ? $request->input("sin_gluten") : null;
        $restaurant->accesible = !empty($request->input("accesible")) ? $request->input("accesible") : null;
        $restaurant->admite_mascotas = !empty($request->input("admite_mascotas")) ? $request->input("admite_mascotas") : null;
        $restaurant->plastic_free = !empty($request->input("plastic_free")) ? $request->input("plastic_free") : null;
        $restaurant->desayuno = !empty($request->input("desayuno")) ? $request->input("desayuno") : null;
        $restaurant->brunch = !empty($request->input("brunch")) ? $request->input("brunch") : null;
        $restaurant->almuerzo = !empty($request->input("almuerzo")) ? $request->input("almuerzo") : null;
        $restaurant->merienda = !empty($request->input("merienda")) ? $request->input("merienda") : null;
        $restaurant->cena = !empty($request->input("cena")) ? $request->input("cena") : null;
        $restaurant->dulce = !empty($request->input("dulce")) ? $request->input("dulce") : null;
        $restaurant->salado = !empty($request->input("salado")) ? $request->input("salado") : null;
        $restaurant->local = !empty($request->input("local")) ? $request->input("local") : null;
        $restaurant->nacional = !empty($request->input("nacional")) ? $request->input("nacional") : null;
        $restaurant->internacional = !empty($request->input("internacional")) ? $request->input("internacional") : null;
        $restaurant->fusion = !empty($request->input("fusion")) ? $request->input("fusion") : null;
        $restaurant->vegetariano = !empty($request->input("vegetariano")) ? $request->input("vegetariano") : null;
        $restaurant->vegano = !empty($request->input("vegano")) ? $request->input("vegano") : null;
        $restaurant->marisco = !empty($request->input("marisco")) ? $request->input("marisco") : null;
        $restaurant->atun = !empty($request->input("atun")) ? $request->input("atun") : null;
        $restaurant->sushi = !empty($request->input("sushi")) ? $request->input("sushi") : null;
        $restaurant->pescado = !empty($request->input("pescado")) ? $request->input("pescado") : null;
        $restaurant->carne = !empty($request->input("carne")) ? $request->input("carne") : null;
        $restaurant->paella = !empty($request->input("paella")) ? $request->input("paella") : null;
        $restaurant->pasta = !empty($request->input("pasta")) ? $request->input("pasta") : null;
        $restaurant->pizza = !empty($request->input("pizza")) ? $request->input("pizza") : null;
        $restaurant->zumos_y_batidos = !empty($request->input("zumos_y_batidos")) ? $request->input("zumos_y_batidos") : null;

        // Actualizamos las imagenes
        if($request->hasfile('filenames'))
        {
            // foreach($request->file('filenames') as $pos => $file)
            // {
            //     $name = $pos.time().'.'.$file->extension();
            //     $file->move(public_path().'/images/restaurantes/', $name);
            //     $data[] = '/images/restaurantes/'.$name;
            // }
            $file = $request->file('filenames');
            $name = time().'.'.$file->extension();
            $file->move(public_path().'/images/restaurantes/', $name);
            $restaurant->imagenes = '/images/restaurantes/'.$name;
        } else if ($request->input('filenames')) {
            // Esto es una imagen de tipo base 64
            $base64File = $request->input('filenames');

            // decode the base64 file
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

            // save it to temporary dir first.
            $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
            file_put_contents($tmpFilePath, $fileData);

            // this just to help us get file info.
            $tmpFile = new File($tmpFilePath);

            $name = $tmpFile->getFilename().'.png';
            $tmpFile->move(public_path().'/images/restaurantes/', $name);
            $restaurant->imagenes = '/images/restaurantes/'.$name;
        }
        $restaurant->tiene_whatsapp = !empty($request->input('tiene_whatsapp')) ? 1 : 0;
        $restaurant->horario = !empty($request->input("horario")) ? $request->input("horario") : null;

        $restaurant->update();

        return view('restaurant.show', ['restaurant' => $restaurant]);
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);

        $restaurant->delete();
        return redirect()->route('home')->with('message', 'Restaurant borrado exitosamente');
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
}
