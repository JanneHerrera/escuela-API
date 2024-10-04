<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;



class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Estudiante::all();
        if ($students->isEmpty()) {
            $data = [
                'message' => 'No se encontraron estudiantes',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        return response()->json($students, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        $student = $estudiante;
        if (!$student) {
            $data = [
                'message' => 'No se encontro al estudiante',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        $data = [
            'student' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'alpha'],
            'registro' => ['required', 'integer', 'digits:8', 'unique:estudiantes,registro'],
            'grado' => ['required', 'integer', 'between:1,8'],
            'grupo' => ['required', 'regex:/^[A-Z]([0-9])?$/'],
            'status' => ['required', Rule::enum(Status::class)]
        ])->validate();


        /** @var Estudiante $student */
        $student = Estudiante::create([
            'nombre' => $request->nombre,
            'registro' => $request->registro,
            'grado' => $request->grado,
            'grupo' => $request->grupo,
            'status' => $request->status,
        ]);
        if (!$student) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 400,
            ];
            return response()->json($data, 400);
        }

        $data = [
            'student' => $student,
            'status' => 201
        ];
        return response()->json($data, 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante): JsonResponse
    {
        $student = $estudiante;

        if (!$student) {
            $data = [
                'message' => 'estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'grado' => ['sometimes', 'required', 'integer', 'between:1,8'],
            'grupo' => ['sometimes', 'required', 'regex:/^[A-Z]([0-9])?$/'],
            'status' => ['sometimes', 'required', Rule::enum(Status::class)]
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => JsonResponse::HTTP_BAD_REQUEST
            ];
            return response()->json($data, JsonResponse::HTTP_BAD_REQUEST);
        }

        $student->grado = $request->grado;
        $student->grupo = $request->grupo;
        $student->status = $request->status;

        $student->save();

        $data = [
            'message' => 'alumno actualizado',
            'student' => $student,
            'status' => 200
        ];

        return new JsonResponse($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante): JsonResponse
    {
        if (!$estudiante) {
            $data = [
                'message' => 'no existe el alumno que deasea eliminar',
                'status' => JsonResponse::HTTP_NO_CONTENT
            ];

            return response()->json($data, JsonResponse::HTTP_NO_CONTENT);
        }
        $estudiante->delete();
        $data = [
            'message' => 'alumno eliminado',
            'student' => $estudiante,
        ];
        return response()->json($data, JsonResponse::HTTP_OK);
    }
}
