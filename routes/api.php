<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerroController;
Route::apiResource('perros', 'PerroController');
Route::get('/perros', [PerroController::class, 'obtenerPerros']);
Route::get('/perros', [PerroController::class, 'obtenerInteracciones']);
Route::post('interacciones', 'InteraccionController@store')->middleware('validar.interaccion');
Route::get('perros/{id}/interacciones', 'PerroController@obtenerInteracciones');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        $user = auth()->user();
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
});

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out successfully'], 200);
})->middleware('auth:sanctum');
