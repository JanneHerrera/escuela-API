<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materias = Materia::all();
        if ($materias->isEmpty()) {
            $data = [
                'message' => 'No hay materias por mostrar',
                'status' => JsonResponse::HTTP_NOT_FOUND
            ];
            return response()->json($data, JsonResponse::HTTP_NOT_FOUND);
        }
        return response()->json($materias, JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre' => ['required', 'string'],
            'docente_id' => 'exists:profesores,id'
        ]);

        $materia = Materia::create([
            'nombre' => $request->nombre,
            'docente_id' => $request->docente_id
        ]);

        $data = [
            'message' => 'materia creada correctamente',
            'status' => JsonResponse::HTTP_CREATED
        ];
        return response()->json($data, JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        if (!$materia) {
            $data = [
                'message' => 'No hay materias por mostrar',
                'status' => JsonResponse::HTTP_NO_CONTENT
            ];

            return response()->json($data, JsonResponse::HTTP_NO_CONTENT);
        }

        return response()->json($materia, JsonResponse::HTTP_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materia $materia)
    {
        //
    }
}
