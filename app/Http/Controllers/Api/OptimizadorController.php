<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OptimizadorService;
use Illuminate\Http\JsonResponse;

class OptimizadorController extends Controller
{
    protected $optimizadorService;

    public function __construct(OptimizadorService $optimizadorService)
    {
        $this->optimizadorService = $optimizadorService;
    }

    /**
     * @OA\Get(
     *     path="/api/optimizador",
     *     summary="Retorna terminales, distritos y tarifas optimizadas",
     *     tags={"Optimizador"},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $data = $this->optimizadorService->obtenerDatos();
        return response()->json($data);
    }
}
