<?php

namespace App\Http\Controllers\Api;

use App\CompactDisc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompactDiscController extends Controller
{
    private $cd;

    public function __construct(CompactDisc $cd)
    {
        $this->cd = $cd;
    }

    public function show(Request $request)
    {
        if ($request->id == null) {
            $cd = $this->cd->all();
        } else {
            $cd = $this->genero->find($request->id);
            if (!$cd) {
                return response()->json(['id' => 'CD não encontrado!'], 404);
            }
        }

        $data = $cd;
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->cd->rules);
        try {
            $cdData =  $request->all();
            $this->cd->create($cdData);
            return response()->json(['ok' => 'CD cadastrado'], 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json($e->getMessage(), 500);
            }
            return response()->json('Erro no cadastro', 500);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->cd->rules);
        try {
            $cdData =  $request->all();
            $cd =  $this->cd->find($request->id);
            if (!$cd) {
                return response()->json(['id' => 'CD não encontrado!'], 404);
            }
            $cd->update($cdData);

            return response()->json(['ok' => 'CD Atualizado com sucesso'], 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json($e->getMessage(), 500);
            }
            return response()->json('Erro ao atualizar cadastro', 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $cd =  $this->cd->find($request->id);
            if (!$cd) {
                return response()->json(['id' => 'CD não encontrado!'], 404);
            }
            $cd->delete();
            return response()->json(['ok' => 'CD ' . $cd->titulo . ' Deletado com sucesso'], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json($e->getMessage(), 500);
            }
            return response()->json('Erro ao deletar', 500);
        }
    }
}
