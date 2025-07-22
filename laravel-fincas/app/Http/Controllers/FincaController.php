<?php

namespace App\Http\Controllers;

use App\Http\Requests\FincaRequest;
use App\Models\Finca;
use App\Models\Propietario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlador para gestión de Fincas
 * 
 * Implementa las operaciones CRUD siguiendo las convenciones de Laravel
 * y aplicando el principio de responsabilidad única.
 */
class FincaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = Finca::with('propietario');

        // Filtros
        if ($request->filled('ciudad')) {
            $query->byCiudad($request->ciudad);
        }

        if ($request->filled('provincia')) {
            $query->byProvincia($request->provincia);
        }

        if ($request->filled('sin_propietario')) {
            $query->sinPropietario();
        }

        $fincas = $query->paginate(15);

        if ($request->expectsJson()) {
            return response()->json($fincas);
        }

        return view('fincas.index', compact('fincas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $propietarios = Propietario::orderBy('nombre')->get();
        return view('fincas.create', compact('propietarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FincaRequest $request): JsonResponse
    {
        try {
            $finca = Finca::crearFinca($request->validated());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Finca creada exitosamente.',
                    'data' => $finca->load('propietario')
                ], 201);
            }

            return redirect()
                ->route('fincas.show', $finca)
                ->with('success', 'Finca creada exitosamente.');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear la finca.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'Error al crear la finca.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Finca $finca): View|JsonResponse
    {
        $finca->load('propietario');

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $finca
            ]);
        }

        return view('fincas.show', compact('finca'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finca $finca): View
    {
        $propietarios = Propietario::orderBy('nombre')->get();
        return view('fincas.edit', compact('finca', 'propietarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FincaRequest $request, Finca $finca): JsonResponse
    {
        try {
            $finca->actualizarFinca($request->validated());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Finca actualizada exitosamente.',
                    'data' => $finca->load('propietario')
                ]);
            }

            return redirect()
                ->route('fincas.show', $finca)
                ->with('success', 'Finca actualizada exitosamente.');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar la finca.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'Error al actualizar la finca.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Finca $finca): JsonResponse
    {
        try {
            $finca->delete();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Finca eliminada exitosamente.'
                ]);
            }

            return redirect()
                ->route('fincas.index')
                ->with('success', 'Finca eliminada exitosamente.');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al eliminar la finca.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error al eliminar la finca.');
        }
    }
}
