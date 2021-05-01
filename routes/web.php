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
Route::post('/categoria/cambiarstatus/{id}', 'CategoriaController@cambiarStatus')->name('categorias.cambiarstatus');
Route::post('/categoria/agregarCategoria', 'CategoriaController@agregarCategoria')->name('categorias.agregarCategoria');
Route::post('/categoria/agregarProducto', 'CategoriaController@agregarProducto')->name('categorias.agregarProducto');
Route::post('/categoria/cambiarCategoria/{id}/{categoria}/{restauranteId}', 'CategoriaController@cambiarCategoria')->name('categorias.cambiarCategoria');
Route::post('/categoria/organizarPlatos/{restauranteId}/', 'CategoriaController@organizarPlatos')->name('categorias.organizarPlatos');
Route::post('/categoria/editarProducto', 'CategoriaController@editarProducto')->name('categorias.editarProducto');
Route::delete('/categoria/eliminarProducto/{id}/{restauranteId}', 'CategoriaController@eliminarProducto')->name('categorias.eliminarProducto');
Route::post('/categoria/editarCategorias/{restauranteId}', 'CategoriaController@editarCategorias')->name('categorias.editarCategorias');

// END CATEGORIAS
