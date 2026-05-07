<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JogoController extends Controller
{
    /**
     * GET /jogos
     * Retorna lista completa de jogos e reviews - Status 200 OK
     */
    public function index()
    {
        $jogos = Jogo::all();
        return response()->json($jogos, 200);
    }

    /**
     * GET /jogos/{id}
     * Busca detalhes de um jogo específico - Status 200 OK
     */
    public function show($id)
    {
        $jogo = Jogo::find($id);

        if (!$jogo) {
            return response()->json(['message' => 'Jogo não encontrado.'], 404);
        }

        return response()->json($jogo, 200);
    }

    /**
     * POST /jogos
     * Cadastra uma nova review de jogo - Status 201 Created
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome'   => 'required|string|max:255',
            'tipo'   => 'required|string|max:100',
            'nota'   => 'required|integer|min:0|max:10',
            'review' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dados inválidos.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $jogo = Jogo::create($validator->validated());

        return response()->json($jogo, 201);
    }

    /**
     * PUT /jogos/{id}
     * Atualiza TODOS os dados de um jogo - Status 200 OK
     */
    public function update(Request $request, $id)
    {
        $jogo = Jogo::find($id);

        if (!$jogo) {
            return response()->json(['message' => 'Jogo não encontrado.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nome'   => 'required|string|max:255',
            'tipo'   => 'required|string|max:100',
            'nota'   => 'required|integer|min:0|max:10',
            'review' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dados inválidos.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $jogo->update($validator->validated());

        return response()->json($jogo, 200);
    }

    /**
     * DELETE /jogos/{id}
     * Remove um jogo - Status 204 No Content (SEM corpo)
     */
    public function destroy($id)
    {
        $jogo = Jogo::find($id);

        if (!$jogo) {
            return response()->json(['message' => 'Jogo não encontrado.'], 404);
        }

        $jogo->delete();

        // 204 No Content: NENHUM corpo de resposta
        return response()->noContent();
    }
}
