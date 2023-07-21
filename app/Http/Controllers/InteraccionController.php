<?php

namespace App\Http\Controllers;
use App\Models\Interaccion;
use Illuminate\Http\Request;

class InteraccionController extends Controller
{
public function guardarPreferencias(Request $request)
{
    $perroInteresadoId = $request->input('perro_interesado_id');
    $perroCandidatoIds = $request->input('perro_candidato_ids');
    $preferencia = $request->input('preferencia');

    foreach ($perroCandidatoIds as $perroCandidatoId) {
        Interaccion::create([
            'perro_interesado_id' => $perroInteresadoId,
            'perro_candidato_id' => $perroCandidatoId,
            'preferencia' => $preferencia,
        ]);
    }

    return response()->json(['message' => 'Preferencias guardadas exitosamente']);
}
    public function store(Request $request){
        return Interaccion::create($request->all());
    }
}
