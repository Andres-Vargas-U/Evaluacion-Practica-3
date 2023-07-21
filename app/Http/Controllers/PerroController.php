<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Perro;
use App\Models\Interaccion;
use Illuminate\Support\Facades\File;

class PerroController extends Controller
{

    public function index()
    {
        return Perro::all();
    }
 
    public function verPerrosInteresados($id)
    {
        // Buscar al perro interesado por su id
        $perroInteresado = Perro::find($id);
    
        if (!$perroInteresado) {
            return response()->json(['message' => 'Perro interesado no encontrado'], 404);
        }
    
        // Obtener los perros que ha aceptado y rechazado el perro interesado
        $perrosAceptados = $perroInteresado->candidatos()->where('preferencia', 'aceptado')->get();
        $perrosRechazados = $perroInteresado->candidatos()->where('preferencia', 'rechazado')->get();
    
        return response()->json([
            'perro_interesado' => $perroInteresado,
            'perros_aceptados' => $perrosAceptados,
            'perros_rechazados' => $perrosRechazados,
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'url_foto' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        return Perro::create($request->all());
    }

    public function show(string $id)
    {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        return $perro;
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'url_foto' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        $perro->update($request->all());
        return $perro;
    }
    public function destroy(string $id)
    {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        $perro->delete();
        return response()->json(['message' => 'Perro eliminado correctamente']);
    }

    public function obtenerInteracciones($id)
    {
          // Obtener el perro por su ID
          $perro = Perro::find($id);

          if (!$perro) {
              return response()->json(['message' => 'Perro no encontrado'], 404);
          }
  
          // Leer el contenido del archivo JSON con ejemplos de interacciones
          $contenidoInteracciones = File::get(public_path('interacciones.json'));
  
          // Decodificar el JSON a un arreglo PHP
          $interacciones = json_decode($contenidoInteracciones, true);
  
          return response()->json([
              'perro_interesado' => $perro,
              'interacciones' => $interacciones,
          ]);
      }
      public function obtenerPerros()
      {
          // Leer el contenido del archivo JSON con ejemplos de perros
          $contenidoPerros = File::get(public_path('perros.json'));
  
          // Decodificar el JSON a un arreglo PHP
          $perros = json_decode($contenidoPerros, true);
          return response()->json($perros);
      }
  
}
