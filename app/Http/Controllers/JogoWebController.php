<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JogoWebController extends Controller
{
    public function index()
    {
        $jogos = Jogo::orderBy('created_at', 'desc')->get();
        return view('jogos.index', compact('jogos'));
    }

    public function show($id)
    {
        $jogo = Jogo::findOrFail($id);
        return view('jogos.show', compact('jogo'));
    }

    public function create()
    {
        return view('jogos.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome'   => 'required|string|max:255',
            'tipo'   => 'required|string|max:100',
            'nota'   => 'required|integer|min:0|max:10',
            'review' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Jogo::create($validator->validated());

        return redirect()->route('jogos.index')
                         ->with('sucesso', 'Jogo cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $jogo = Jogo::findOrFail($id);
        return view('jogos.edit', compact('jogo'));
    }

    public function update(Request $request, $id)
    {
        $jogo = Jogo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome'   => 'required|string|max:255',
            'tipo'   => 'required|string|max:100',
            'nota'   => 'required|integer|min:0|max:10',
            'review' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $jogo->update($validator->validated());

        return redirect()->route('jogos.index')
                         ->with('sucesso', 'Jogo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $jogo = Jogo::findOrFail($id);
        $jogo->delete();

        return redirect()->route('jogos.index')
                         ->with('sucesso', 'Jogo removido com sucesso!');
    }
}
