<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Restaurant;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('email', '!=' , "admin@admin.com")->get();
        return view("users.index", ['users' => $users]);
    }

    public function agregar()
    {
        return view("users.agregar");
    }

    public function crear(Request $request){

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('restaurant.index')->with('Notificacion','Usuario creado exitosamente');

    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view("users.edit", ['user' => $user]);
    }
    public function update(Request $request)
    {
        $user = User::where('id', $request->input('id'))->first();
        $user->profile = $request->input('profile');
        $user->update();

        $users = User::where('email', '!=' , "admin@admin.com")->get();
        return view("users.index", ['users' => $users]);
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->delete();
        $users = User::where('email', '!=' , "admin@admin.com")->get();
        return redirect()->route('users.index', ['users' => $users])->with('Notificacion', 'Usuario eliminado exitosamente');
    }

    public function createRestaurant(){
        return view("users.createRestaurant");
    }

    public function restaurantStore(Request $request){
        // Crear y guardar el Restaurant con los datos validados:
        $restaurant = new Restaurant;
        $restaurant->nombre = !empty($request->input("nombre")) ? $request->input("nombre") : null;
        $restaurant->direccion = !empty($request->input("direccion")) ? $request->input("direccion") : null;
        $restaurant->ciudad = !empty($request->input("ciudad")) ? $request->input("ciudad") : null;
        $restaurant->pais = !empty($request->input("pais")) ? $request->input("pais") : null;
        $restaurant->telefono = !empty($request->input("telefono")) ? $request->input("telefono") : null;
        $restaurant->google_maps = !empty($request->input("google_maps")) ? $request->input("google_maps") : null;
        $restaurant->categorias = !empty($request->input("categorias")) ? $request->input("categorias") : "[]";

        $restaurant->precio1 = !empty($request->input("precio1")) ? $request->input("precio1") : null;
        $restaurant->precio2 = !empty($request->input("precio2")) ? $request->input("precio2") : null;
        $restaurant->precio3 = !empty($request->input("precio3")) ? $request->input("precio3") : null;
        $restaurant->restaurante = !empty($request->input("restaurante")) ? $request->input("restaurante") : null;
        $restaurant->cafeteria = !empty($request->input("cafeteria")) ? $request->input("cafeteria") : null;
        $restaurant->bar = !empty($request->input("bar")) ? $request->input("bar") : null;
        $restaurant->restaurante_playa = !empty($request->input("restaurante_playa")) ? $request->input("restaurante_playa") : null;
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
        $restaurant['status'] = 3;
        // Guardamos las imagenes que vienen como ARCHIVO
        if($request->hasfile('filenames'))
        {
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
            $restaurant->imagenes = '/images/restaurantes/'.$name;
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

                $name = $tmpFile->getFilename().'.png';
                $tmpFile->move(public_path().'/images/restaurantes/', $name);
                $arrNamesImgs[] = '/images/restaurantes/'.$name;
            }
            $restaurant->imagenes = json_encode($arrNamesImgs) ;
        }
        $restaurant->tiene_whatsapp = !empty($request->input('tiene_whatsapp')) ? 1 : 0;
        $restaurant->horario = !empty($request->input("horario")) ? $request->input("horario") : null;

        $restaurant->save();

        return redirect(route('index'))->with('Notificacion', 'Datos enviados, espere por aprobación');

    }
}
