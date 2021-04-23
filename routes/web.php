<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/directorio', 'DirectorioController@index')->name('directorio');
Route::get('/directorio/detail/{id}', 'DirectorioController@show')->name('directorio.detail');
Route::post('/directorio/enviarCorreo', 'DirectorioController@enviarCorreo')->name('directorio.enviarCorreo');
Route::post('/directorio/obtenerResultadosFiltros', 'DirectorioController@obtenerResultadosFiltros')->name('directorio.obtenerResultadosFiltros');

Route::get('/restaurant', 'RestaurantController@index')->name('restaurant.index');
Route::get('/restaurant/listado', 'RestaurantController@listado')->name('restaurant.listado');
Route::get('/restaurant/create', 'RestaurantController@create')->name('restaurant.create');
Route::post('/restaurant/store', 'RestaurantController@store')->name('restaurant.store');
Route::get('/restaurant/show/{id}', 'RestaurantController@show')->name('restaurant.show');
Route::get('/restaurant/edit/{id}', 'RestaurantController@edit')->name('restaurant.edit');
Route::post('/restaurant/update/{id}', 'RestaurantController@update')->name('restaurant.update');
Route::post('/restaurant/destroy/{id}', 'RestaurantController@destroy')->name('restaurant.destroy');
Route::get('/restaurant/changestatus/{id}', 'RestaurantController@cambiarStatus')->name('restaurant.cambiar_status');

Route::get('/users/index', 'UserController@index')->name('users.index');
Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::post('/users/update', 'UserController@update')->name('users.update');

// START CATEGORIAS
Route::get('/categoria/index/{id}', 'CategoriaController@index')->name('categorias.index');
Route::post('/categoria/cambiarstatus/{id}/{nombre}', 'CategoriaController@cambiarStatus')->name('categorias.cambiarstatus');

Route::post('/categoria/AddNewProductoEntrante', 'CategoriaController@AddNewProductoEntrante')->name('categorias.AddNewProductoEntrante');
Route::post('/categoria/editarEntrante', 'CategoriaController@editarEntrante')->name('categorias.editarEntrante');
Route::delete('/categoria/eliminarEntrante/{id}', 'CategoriaController@eliminarEntrante')->name('categorias.eliminarEntrante');

Route::post('/categoria/AddNewProductoSopa', 'CategoriaController@AddNewProductoSopa')->name('categorias.AddNewProductoSopa');
Route::delete('/categoria/eliminarSopa/{id}', 'CategoriaController@eliminarSopa')->name('categorias.eliminarSopa');

Route::post('/categoria/AddNewProductoFrito', 'CategoriaController@AddNewProductoFrito')->name('categorias.AddNewProductoFrito');
Route::delete('/categoria/eliminarFrito/{id}', 'CategoriaController@eliminarFrito')->name('categorias.eliminarFrito');

Route::post('/categoria/AddNewProductoCarne', 'CategoriaController@AddNewProductoCarne')->name('categorias.AddNewProductoCarne');
Route::delete('/categoria/eliminarCarne/{id}', 'CategoriaController@eliminarCarne')->name('categorias.eliminarCarne');

Route::post('/categoria/AddNewProductoPescado', 'CategoriaController@AddNewProductoPescado')->name('categorias.AddNewProductoPescado');
Route::delete('/categoria/eliminarPescado/{id}', 'CategoriaController@eliminarPescado')->name('categorias.eliminarPescado');

Route::post('/categoria/AddNewProductoPasta', 'CategoriaController@AddNewProductoPasta')->name('categorias.AddNewProductoPasta');
Route::delete('/categoria/eliminarPasta/{id}', 'CategoriaController@eliminarPasta')->name('categorias.eliminarPasta');

Route::post('/categoria/AddNewProductoPostre', 'CategoriaController@AddNewProductoPostre')->name('categorias.AddNewProductoPostre');
Route::delete('/categoria/eliminarPostre/{id}', 'CategoriaController@eliminarPostre')->name('categorias.eliminarPostre');

Route::post('/categoria/AddNewProductoBebida', 'CategoriaController@AddNewProductoBebida')->name('categorias.AddNewProductoBebida');
Route::delete('/categoria/eliminarBebida/{id}', 'CategoriaController@eliminarBebida')->name('categorias.eliminarBebida');
// END CATEGORIAS
