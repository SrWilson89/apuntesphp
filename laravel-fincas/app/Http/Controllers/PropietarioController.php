<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropietarioRequest;
use App\Models\Propietario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlador para gestión de Propietarios
 * 
 * Implementa las operaciones CRUD siguiendo las convenciones de Laravel
 * y aplicando el principio de responsabilidad única.
 */
class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = Propietario::with('fincas');

        // Filtro por búsqueda
        if ($request->filled('search')) {
            $query->byNombre($request->search);
        }

        $propietarios = $query->paginate(15);

        if ($request->expectsJson()) {
            return response()->json($propietarios);
        }

        return view('propietarios.index', compact('propietarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('propietarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropietarioRequest $request): JsonResponse
    {
        try {
            $propietario = Propietario::crearPropietario($request->validated());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Propietario creado exitosamente.',
                    'data' => $propietario->load('fincas')
                ], 201);
            }

            return redirect()
                ->route('propietarios.show', $propietario)
                ->with('success', 'Propietario creado exitosamente.');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear el propietario.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'Error al crear el propietario.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Propietario $propietario): View|JsonResponse
    {
        $propietario->load('fincas');

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $propietario
            ]);
        }

        return view('propietarios.show', compact('propietario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Propietario $propietario): View
    {
        return view('propietarios.edit', compact('propietario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropietarioRequest $request, Propietario $propietario): JsonResponse
    {
        try {
            $propietario->actualizarPropietario($request->validated());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Propietario actualizado exitosamente.',
                    'data' => $propietario->load('fincas')
                ]);
            }

            return redirect()
                ->route('propietarios.show', $propietario)
                ->with('success', 'Propietario actualizado exitosamente.');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el propietario.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'Error al actualizar el propietario.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Propietario $propietario): JsonResponse
    {
        try {
            $propietario->eliminarPropietario();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Propietario eliminado exitosamente.'
                ]);
            }

            return redirect()
                ->route('propietarios.index')
                ->with('success', 'Propietario eliminado exitosamente.');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al eliminar el propietario.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error al eliminar el propietario.');
        }
    }
}
