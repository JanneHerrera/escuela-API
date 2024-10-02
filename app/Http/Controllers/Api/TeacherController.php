<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Whoops\Handler\JsonResponseHandler;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $teachers = Docente::all();

        if ($teachers->isEmpty()) {
            $data = [
                'message' => 'No se encontraron profesores registrados',
                'status' => JsonResponse::HTTP_ACCEPTED
            ];
            return response()->json($data, JsonResponse::HTTP_NO_CONTENT);
        }

        return response()->json($teachers, JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente): JsonResponse
    {
        if (!$docente) {
            $data = [
                'message' => 'No existe el estudiante',
                'status' => JsonResponse::HTTP_NO_CONTENT
            ];
            return response()->json($data, JsonResponse::HTTP_NO_CONTENT);
        }
        $data = [
            'message' => 'profe tal',
            'docente' => $docente,
            'status' => JsonResponse::HTTP_OK
        ];
        return response()->json($data, JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {

        $validate = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'alpha'],
            'especialidad' => ['sometimes', 'nullable', 'string'],
            'nomina' => ['required', 'numeric', 'min:100']
        ])->validate();
        /** @var Docente $docente*/
        $docente = Docente::create([
            'nombre' => $request->nombre,
            'especialidad' => $request->especialidad,
            'nomina' => $request->nomina
        ]);
        if (!$docente) {
            $data = [
                'message' => 'error al registrar al docente',
                'status' => JsonResponse::HTTP_BAD_REQUEST
            ];
            return response()->json($data, JsonResponse::HTTP_BAD_REQUEST);
        }
        return response()->json($docente, JsonResponse::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Docente $docente): JsonResponse
    {
        if (!$docente) {
            $data = [
                'message' => 'no se encontro al estudiante para modificar',
                'status' => JsonResponse::HTTP_BAD_REQUEST
            ];
            return response()->json($data, JsonResponse::HTTP_BAD_REQUEST);
        }
        $validate = Validator::make($request->all(), [
            'nomina' => ['required', 'numeric', 'min:100']
        ]);
        $data = [
            'message' => 'Docente actualizado correctamente',
            'status' => JsonResponse::HTTP_ACCEPTED
        ];
        return response()->json($data, JsonResponse::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docente $docente): JsonResponse
    {
        if (!$docente) {
            $data = [
                'message' => 'no existe el docente que desea eliminar',
                'status' => JsonResponse::HTTP_BAD_REQUEST
            ];
            return response()->json($data, JsonResponse::HTTP_BAD_REQUEST);
        }

        $docente->delete();
        $data = [
            'message' => 'Docente eliminado correctamente',
            'status' => JsonResponse::HTTP_ACCEPTED
        ];
        return response()->json($data, JsonResponse::HTTP_ACCEPTED);
    }
}
