<?php

use App\User;
use App\Can;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
  return view('welcome');
});


// Api can

Route::get('/api/can/', function () {
  $cans = Can::all();
  return json_encode($cans);
});

Route::options('/api/can');


// create

Route::post('/api/can', function (Request $request) {

  // validacion

  $validation = Validator::make($request->all(),[ 
            'nombre_lata' => 'required|string',
            'color_principal' => 'required',
            'nacionalidad' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'who_user' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
  ]);

  if($validation->fails()){
      return response()->json([
          'error' => true,
          'messages'  => $validation->errors(),
      ], 200);
  }

  $can = Can::where('nombre_lata', $request->input('nombre_lata'))->count();
  
  if (!$can) {
    $can = new Can();
    $can->nombre_lata = $request->input('nombre_lata');
    $can->color_principal = $request->input('color_principal');
    $can->nacionalidad = $request->input('nacionalidad');
    $can->who_user = $request->input('who_user');
    $can->save();
    return json_encode($can);
  }
  return response("Can already exists.", 409);

});

// eliminar

Route::options('/api/can/{id}');

Route::delete('/api/can/{id}', function (Request $request, $id) {
  $can = Can::find($id);
  if ($can) {
    $can->delete();
    return json_encode('OK');
  }
  return response("Can not found", 404);
});

// edit

Route::put('/api/can/{id}', function (Request $request, $id) {
  
  $validation = Validator::make($request->all(),[ 
            'nombre_lata' => 'required|string',
            'color_principal' => 'required',
            'nacionalidad' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
            'who_user' => ['required', 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/'],
  ]);

  if($validation->fails()){
      return response()->json([
          'error' => true,
          'messages'  => $validation->errors(),
      ], 200);
  }

  $can = Can::find($id);

  if ($can) {
    $can->nombre_lata = $request->input('nombre_lata');
    $can->color_principal = $request->input('color_principal');
    $can->nacionalidad = $request->input('nacionalidad');
    $can->who_user = $request->input('who_user');
    $can->save();
    return json_encode($can);
  }
  return response("Can not found", 404);
});

//User 

Route::get('/api/user/', function () {
  $users = User::all();
  return json_encode($users);
});

Route::options('/api/user');
Route::post('/api/user', function (Request $request) {
  $user = User::where('email', $request->input('email'))->count();
  if (!$user) {
    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save();
    return json_encode($user);
  }
  return response("User already exists.", 409);
});

Route::options('/api/user/{id}');
Route::delete('/api/user/{id}', function (Request $request, $id) {
  $user = User::find($id);
  if ($user) {
    $user->delete();
    return json_encode('OK');
  }
  return response("User not found", 404);
});

Route::put('/api/user/{id}', function (Request $request, $id) {
  $user = User::find($id);
  if ($user) {
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save();
    return json_encode($user);
  }
  return response("User not found", 404);
});


