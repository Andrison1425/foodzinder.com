<?php

namespace App\Http\Controllers;

use App\Directorio;
use Illuminate\Http\Request;
use App\Restaurant;
use App\User;

class DirectorioController extends Controller
{
    public function index(Request $request)
    {

        $palabra_busqueda = (!empty($request->input("palabra_busqueda"))) ? '%'.$request->input("palabra_busqueda").'%' : "%";
        $ciudad = (!empty($request->input("ciudad"))) ? '%'.$request->input("ciudad").'%' : '%';
        $precio1 = (!empty($request->input('precio1'))) ? 'on' : null;
        $precio2 = (!empty($request->input('precio2'))) ? 'on' : null;
        $precio3 = (!empty($request->input('precio3'))) ? 'on' : null;
        $restaurante = (!empty($request->input('restaurante'))) ? 'on' : null;
        $cafeteria = (!empty($request->input('cafeteria'))) ? 'on' : null;
        $bar = (!empty($request->input('bar'))) ? 'on' : null;
        $restaurante_playa = (!empty($request->input('restaurante_playa'))) ? 'on' : null;
        $admite_reservas = (!empty($request->input('admite_reservas'))) ? 'on' : null;
        $para_llevar = (!empty($request->input('para_llevar'))) ? 'on' : null;
        $domicilio = (!empty($request->input('domicilio'))) ? 'on' : null;
        $terraza_exterior = (!empty($request->input('terraza_exterior'))) ? 'on' : null;
        $wifi_gratuito = (!empty($request->input('wifi_gratuito'))) ? 'on' : null;
        $sin_gluten = (!empty($request->input('sin_gluten'))) ? 'on' : null;
        $accesible = (!empty($request->input('accesible'))) ? 'on' : null;
        $admite_mascotas = (!empty($request->input('admite_mascotas'))) ? 'on' : null;
        $plastic_free = (!empty($request->input('plastic_free'))) ? 'on' : null;
        $desayuno = (!empty($request->input('desayuno'))) ? 'on' : null;
        $brunch = (!empty($request->input('brunch'))) ? 'on' : null;
        $almuerzo = (!empty($request->input('almuerzo'))) ? 'on' : null;
        $merienda = (!empty($request->input('merienda'))) ? 'on' : null;
        $cena = (!empty($request->input('cena'))) ? 'on' : null;
        $dulce = (!empty($request->input('dulce'))) ? 'on' : null;
        $salado = (!empty($request->input('salado'))) ? 'on' : null;
        $local = (!empty($request->input('local'))) ? 'on' : null;
        $nacional = (!empty($request->input('nacional'))) ? 'on' : null;
        $internacional = (!empty($request->input('internacional'))) ? 'on' : null;
        $fusion = (!empty($request->input('fusion'))) ? 'on' : null;
        $vegetariano = (!empty($request->input('vegetariano'))) ? 'on' : null;
        $vegano = (!empty($request->input('vegano'))) ? 'on' : null;
        $marisco = (!empty($request->input('marisco'))) ? 'on' : null;
        $atun = (!empty($request->input('atun'))) ? 'on' : null;
        $sushi = (!empty($request->input('sushi'))) ? 'on' : null;
        $pescado = (!empty($request->input('pescado'))) ? 'on' : null;
        $carne = (!empty($request->input('carne'))) ? 'on' : null;
        $paella = (!empty($request->input('paella'))) ? 'on' : null;
        $pasta = (!empty($request->input('pasta'))) ? 'on' : null;
        $pizza = (!empty($request->input('pizza'))) ? 'on' : null;
        $zumos_y_batidos = (!empty($request->input('zumos_y_batidos'))) ? 'on' : null;

        $filtro = [];
        if ($palabra_busqueda) {array_push($filtro, ['nombre', 'like', $palabra_busqueda]);}
        if ($ciudad) {array_push($filtro, ['ciudad', 'like', $ciudad]);}
        if ($precio1) {array_push($filtro, ['precio1', 'like', 'on']);}
        if ($precio2) {array_push($filtro, ['precio2', 'like', 'on']);}
        if ($precio3) {array_push($filtro, ['precio3', 'like', 'on']);}
        if ($restaurante) {array_push($filtro, ['restaurante', 'like', 'on']);}
        if ($cafeteria) {array_push($filtro, ['cafeteria', 'like', 'on']);}
        if ($bar) {array_push($filtro, ['bar', 'like', 'on']);}
        if ($restaurante_playa) {array_push($filtro, ['restaurante_playa', 'like', 'on']);}
        if ($admite_reservas) {array_push($filtro, ['admite_reservas', 'like', 'on']);}
        if ($para_llevar) {array_push($filtro, ['para_llevar', 'like', 'on']);}
        if ($domicilio) {array_push($filtro, ['domicilio', 'like', 'on']);}
        if ($terraza_exterior) {array_push($filtro, ['terraza_exterior', 'like', 'on']);}
        if ($wifi_gratuito) {array_push($filtro, ['wifi_gratuito', 'like', 'on']);}
        if ($sin_gluten) {array_push($filtro, ['sin_gluten', 'like', 'on']);}
        if ($accesible) {array_push($filtro, ['accesible', 'like', 'on']);}
        if ($admite_mascotas) {array_push($filtro, ['admite_mascotas', 'like', 'on']);}
        if ($plastic_free) {array_push($filtro, ['plastic_free', 'like', 'on']);}
        if ($desayuno) {array_push($filtro, ['desayuno', 'like', 'on']);}
        if ($brunch) {array_push($filtro, ['brunch', 'like', 'on']);}
        if ($almuerzo) {array_push($filtro, ['almuerzo', 'like', 'on']);}
        if ($merienda) {array_push($filtro, ['merienda', 'like', 'on']);}
        if ($cena) {array_push($filtro, ['cena', 'like', 'on']);}
        if ($dulce) {array_push($filtro, ['dulce', 'like', 'on']);}
        if ($salado) {array_push($filtro, ['salado', 'like', 'on']);}
        if ($local) {array_push($filtro, ['local', 'like', 'on']);}
        if ($nacional) {array_push($filtro, ['nacional', 'like', 'on']);}
        if ($internacional) {array_push($filtro, ['internacional', 'like', 'on']);}
        if ($fusion) {array_push($filtro, ['fusion', 'like', 'on']);}
        if ($vegetariano) {array_push($filtro, ['vegetariano', 'like', 'on']);}
        if ($vegano) {array_push($filtro, ['vegano', 'like', 'on']);}
        if ($marisco) {array_push($filtro, ['marisco', 'like', 'on']);}
        if ($atun) {array_push($filtro, ['atun', 'like', 'on']);}
        if ($sushi) {array_push($filtro, ['sushi', 'like', 'on']);}
        if ($pescado) {array_push($filtro, ['pescado', 'like', 'on']);}
        if ($carne) {array_push($filtro, ['carne', 'like', 'on']);}
        if ($paella) {array_push($filtro, ['paella', 'like', 'on']);}
        if ($pasta) {array_push($filtro, ['pasta', 'like', 'on']);}
        if ($pizza) {array_push($filtro, ['pizza', 'like', 'on']);}
        if ($zumos_y_batidos) {array_push($filtro, ['zumos_y_batidos', 'like', 'on']);}

        $restaurantes_sin_paginar = Restaurant::where($filtro)->where('status', 1)->get();
        $restaurantes = '';

        $restaurantes =Restaurant::orderBy('id', 'desc')->where($filtro)->where('status', 1)->paginate(6);

        $admin = User::where('email', '=' , "admin@admin.com")->get();
        foreach ($admin as $key => $value) {
            $admin=$value;
        }

        $prioridad=json_decode($admin->prioridad);

        $arrRestaurantes=[];
        $cont2=count($restaurantes_sin_paginar);
        foreach($restaurantes_sin_paginar as $restaurante){
            if(in_array($restaurante->id, $prioridad)){
                $cont2--;
            }
        }


        if($prioridad && $restaurantes->currentPage()==1){
            foreach($restaurantes_sin_paginar as $restaurante){
                $arrRestaurantes[$restaurante->id]=$restaurante;
            }
            $array_ordenado = array_replace( array_flip( $prioridad ), $arrRestaurantes );
            $restaurantes->setCollection(collect(array_slice($array_ordenado,0,6)));
        }else{
            $cont=0;

            foreach($restaurantes as $restaurante){
                if(in_array($restaurante->id, $prioridad)){
                    unset($restaurantes[$cont]);
                    unset($restaurantes_sin_paginar[$cont]);
                }
                $cont++;
            }
        }

        $cantidades = $this->TraerCantidades($restaurantes_sin_paginar);
        return view('directorio', ["request" => $request,
                                   "restaurantes" => $restaurantes,
                                   'cantidades' => $cantidades,
                                   "restaurantes_sin_paginar" => $cont2
                                   ]);
    }

    public function TraerCantidades($restaurantes)
    {

        $cantidades = [];
        $palabras = ['precio1','precio2','precio3','restaurante','cafeteria','bar','restaurante_playa','admite_reservas','para_llevar','domicilio','terraza_exterior','wifi_gratuito','sin_gluten','accesible','admite_mascotas','plastic_free','desayuno','brunch','almuerzo', 'merienda', 'cena','dulce','salado','local','nacional','internacional','fusion','vegetariano','vegano','marisco','atun','sushi','pescado','carne','paella','pasta','pizza','zumos_y_batidos'];

        foreach ($palabras as $palabra) {
            $cantidades[$palabra] = [];
        }
        if (count($restaurantes) <= 0) {
            return $cantidades;
        }
        $cantidades['total'] = count($restaurantes);

        foreach ($restaurantes as $restaurant) {
            foreach ($palabras as $palabra) {
                if ($restaurant->$palabra == 'on') {array_push($cantidades[$palabra], $restaurant);}
            }
        }
        return $cantidades;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id,$name)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->categorias=json_decode($restaurant->categorias,true);
        $imagenes=json_decode($restaurant->imagenes,true);
        $platos=$restaurant->platos;
        $arrPlatos=[];
        $i=0;

        foreach($platos as $plato){
            $plato->pos=$i;
            $arrPlatos[]=$plato;
            $i++;
        }

        $orden = json_decode($restaurant->posiciones);

        if($orden && $arrPlatos){
            $array_ordenado = array_replace( array_flip( $orden ), $arrPlatos );
            $platos=$array_ordenado;
        }

        return view("restaurant_detail", ['restaurant' => $restaurant,
                                         'imagenes'    =>$imagenes,
                                         'platos'      =>$platos
                                         ]);
    }

    public function obtenerResultadosNombre(Request $request)
    {
        $nombre=$request->palabra_busqueda;
        $restaurantes =Restaurant::where('nombre', 'like', "%$nombre%")->where('status', 1)->limit(6)->get();
        return json_encode($restaurantes);
    }

    public function update(Request $request, Directorio $directorio)
    {
        //
    }

    public function destroy(Directorio $directorio)
    {
        //
    }

    public function enviarCorreo(Request $request)
    {
        $restaurante='';
        if($request->restaurante){
            $restaurante=$request->restaurante;
        }

        $to = 'foodzinder@gmail.com';
        $subject = "Correo enviado desde Food Zinder";
        $message = "
            Nombre completo:$request->name.
            Ciudad: $request->ciudad.
            Teléfono: $request->telefono.
            Restaurante: $restaurante.
            email: $request->email.
            Mensaje: $request->mensaje
        ";
        $headers = "Desde: $request->email";

        mail($to, $subject, $message, $headers);

        return redirect()->route('index',[$request->id])->with("Notificacion","Se ha enviado el mensaje");
    }

    public function obtenerResultadosFiltros(Request $request)
    {
        $palabra_busqueda = (!empty($request->input("palabra_busqueda"))) ? '%'.$request->input("palabra_busqueda").'%' : "%";
        $ciudad = (!empty($request->input("ciudad"))) ? '%'.$request->input("ciudad").'%' : '%';
        $precio1 = (!empty($request->input('precio1'))) ? 'on' : null;
        $precio2 = (!empty($request->input('precio2'))) ? 'on' : null;
        $precio3 = (!empty($request->input('precio3'))) ? 'on' : null;
        $restaurante = (!empty($request->input('restaurante'))) ? 'on' : null;
        $cafeteria = (!empty($request->input('cafeteria'))) ? 'on' : null;
        $bar = (!empty($request->input('bar'))) ? 'on' : null;
        $restaurante_playa = (!empty($request->input('restaurante_playa'))) ? 'on' : null;
        $admite_reservas = (!empty($request->input('admite_reservas'))) ? 'on' : null;
        $para_llevar = (!empty($request->input('para_llevar'))) ? 'on' : null;
        $domicilio = (!empty($request->input('domicilio'))) ? 'on' : null;
        $terraza_exterior = (!empty($request->input('terraza_exterior'))) ? 'on' : null;
        $wifi_gratuito = (!empty($request->input('wifi_gratuito'))) ? 'on' : null;
        $sin_gluten = (!empty($request->input('sin_gluten'))) ? 'on' : null;
        $accesible = (!empty($request->input('accesible'))) ? 'on' : null;
        $admite_mascotas = (!empty($request->input('admite_mascotas'))) ? 'on' : null;
        $plastic_free = (!empty($request->input('plastic_free'))) ? 'on' : null;
        $desayuno = (!empty($request->input('desayuno'))) ? 'on' : null;
        $brunch = (!empty($request->input('brunch'))) ? 'on' : null;
        $almuerzo = (!empty($request->input('almuerzo'))) ? 'on' : null;
        $merienda = (!empty($request->input('merienda'))) ? 'on' : null;
        $cena = (!empty($request->input('cena'))) ? 'on' : null;
        $dulce = (!empty($request->input('dulce'))) ? 'on' : null;
        $salado = (!empty($request->input('salado'))) ? 'on' : null;
        $local = (!empty($request->input('local'))) ? 'on' : null;
        $nacional = (!empty($request->input('nacional'))) ? 'on' : null;
        $internacional = (!empty($request->input('internacional'))) ? 'on' : null;
        $fusion = (!empty($request->input('fusion'))) ? 'on' : null;
        $vegetariano = (!empty($request->input('vegetariano'))) ? 'on' : null;
        $vegano = (!empty($request->input('vegano'))) ? 'on' : null;
        $marisco = (!empty($request->input('marisco'))) ? 'on' : null;
        $atun = (!empty($request->input('atun'))) ? 'on' : null;
        $sushi = (!empty($request->input('sushi'))) ? 'on' : null;
        $pescado = (!empty($request->input('pescado'))) ? 'on' : null;
        $carne = (!empty($request->input('carne'))) ? 'on' : null;
        $paella = (!empty($request->input('paella'))) ? 'on' : null;
        $pasta = (!empty($request->input('pasta'))) ? 'on' : null;
        $pizza = (!empty($request->input('pizza'))) ? 'on' : null;
        $zumos_y_batidos = (!empty($request->input('zumos_y_batidos'))) ? 'on' : null;

        $filtro = [];
        if ($palabra_busqueda) {array_push($filtro, ['nombre', 'like', $palabra_busqueda]);}
        if ($ciudad) {array_push($filtro, ['ciudad', 'like', $ciudad]);}
        if ($precio1) {array_push($filtro, ['precio1', 'like', 'on']);}
        if ($precio2) {array_push($filtro, ['precio2', 'like', 'on']);}
        if ($precio3) {array_push($filtro, ['precio3', 'like', 'on']);}
        if ($restaurante) {array_push($filtro, ['restaurante', 'like', 'on']);}
        if ($cafeteria) {array_push($filtro, ['cafeteria', 'like', 'on']);}
        if ($bar) {array_push($filtro, ['bar', 'like', 'on']);}
        if ($restaurante_playa) {array_push($filtro, ['restaurante_playa', 'like', 'on']);}
        if ($admite_reservas) {array_push($filtro, ['admite_reservas', 'like', 'on']);}
        if ($para_llevar) {array_push($filtro, ['para_llevar', 'like', 'on']);}
        if ($domicilio) {array_push($filtro, ['domicilio', 'like', 'on']);}
        if ($terraza_exterior) {array_push($filtro, ['terraza_exterior', 'like', 'on']);}
        if ($wifi_gratuito) {array_push($filtro, ['wifi_gratuito', 'like', 'on']);}
        if ($sin_gluten) {array_push($filtro, ['sin_gluten', 'like', 'on']);}
        if ($accesible) {array_push($filtro, ['accesible', 'like', 'on']);}
        if ($admite_mascotas) {array_push($filtro, ['admite_mascotas', 'like', 'on']);}
        if ($plastic_free) {array_push($filtro, ['plastic_free', 'like', 'on']);}
        if ($desayuno) {array_push($filtro, ['desayuno', 'like', 'on']);}
        if ($brunch) {array_push($filtro, ['brunch', 'like', 'on']);}
        if ($almuerzo) {array_push($filtro, ['almuerzo', 'like', 'on']);}
        if ($merienda) {array_push($filtro, ['merienda', 'like', 'on']);}
        if ($cena) {array_push($filtro, ['cena', 'like', 'on']);}
        if ($dulce) {array_push($filtro, ['dulce', 'like', 'on']);}
        if ($salado) {array_push($filtro, ['salado', 'like', 'on']);}
        if ($local) {array_push($filtro, ['local', 'like', 'on']);}
        if ($nacional) {array_push($filtro, ['nacional', 'like', 'on']);}
        if ($internacional) {array_push($filtro, ['internacional', 'like', 'on']);}
        if ($fusion) {array_push($filtro, ['fusion', 'like', 'on']);}
        if ($vegetariano) {array_push($filtro, ['vegetariano', 'like', 'on']);}
        if ($vegano) {array_push($filtro, ['vegano', 'like', 'on']);}
        if ($marisco) {array_push($filtro, ['marisco', 'like', 'on']);}
        if ($atun) {array_push($filtro, ['atun', 'like', 'on']);}
        if ($sushi) {array_push($filtro, ['sushi', 'like', 'on']);}
        if ($pescado) {array_push($filtro, ['pescado', 'like', 'on']);}
        if ($carne) {array_push($filtro, ['carne', 'like', 'on']);}
        if ($paella) {array_push($filtro, ['paella', 'like', 'on']);}
        if ($pasta) {array_push($filtro, ['pasta', 'like', 'on']);}
        if ($pizza) {array_push($filtro, ['pizza', 'like', 'on']);}
        if ($zumos_y_batidos) {array_push($filtro, ['zumos_y_batidos', 'like', 'on']);}

        $restaurantes_sin_paginar = Restaurant::where($filtro)->where('status', 1)->get();

        $count=count($restaurantes_sin_paginar);

        return $count;
    }
}
