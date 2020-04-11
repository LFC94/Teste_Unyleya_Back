<?php

namespace App\Http\Controllers\Api;

use App\Genero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneroController extends Controller
{
    private $genero;

    public function __construct(Genero $genero)
    {
        $this->genero = $genero;
    }

    public function show(Request $request)
    {   
        if ($request->id == null) {
            $genero = $this->genero->all();
        } else {
            $genero = $this->genero->find($request->id);
            if (!$genero) {
                return response()->json(['id'=>'Genero não encontrado!'],404); 
            }
        } 
        return response()->json($genero);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->genero->rules);
        try {
            $generoData =  $request->all();
            $this->genero->create($generoData);
            return response()->json(['ok' => 'Genero cadastrado'], 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json($e->getMessage(),500);
            }
            return response()->json('Erro no cadastro',500);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->genero->rules);
        try {
            $generoData =  $request->all();
            $genero =  $this->genero->find($request->id);
            if (!$genero) {
                return response()->json(['id'=>'Genero não encontrado!'],404); 
            }
            $genero->update($generoData);

            return response()->json(['ok' => 'Genero Atualizado com sucesso'], 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json($e->getMessage(),500);
            }
            return response()->json('Erro ao atualizar cadastro',500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $genero =  $this->genero->find($request->id);
            if (!$genero) {
                return response()->json(['id'=>'Genero não encontrado!'],404); 
            }
            $genero->delete();
            return response()->json(['ok' => 'Genero '.$genero->descricao.' Deletado com sucesso'], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json($e->getMessage(),500);
            }
            return response()->json('Erro ao deletar',500);
        }
    }
}
