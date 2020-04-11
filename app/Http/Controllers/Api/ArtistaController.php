<?php

namespace App\Http\Controllers\Api;

use App\Artista;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistaController extends Controller
{
    private $artista;

    public function __construct(Artista $artista)
    {
        $this->artista = $artista;
    }

    public function show(Request $request)
    {
        if ($request->id == null) {
            $artista = $this->artista->all();
        } else {
            $artista = $this->artista->find($request->id);
            if (!$artista) {
                $msg = ['id' => 'Artista não encontrado!'];
                return response()->json($msg, 404);
            }
        }
        $data = $artista;
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->artista->rules);
        try {
            $this->artista->create($request->all());
            return response()->json(['ok' => 'Artista cadastrado'], 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json($e->getMessage(), 500);
            }
            return response()->json('Erro no cadastro', 500);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->artista->rules);
        try {
            $artistaData =  $request->all();
            $artista =  $this->artista->find($request->id);
            if (!$artista) {
                return response()->json(['id' => 'Artista não encontrado!'], 404);
            }
            $artista->update($artistaData);

            return response()->json(['ok' => 'Artista Atualizado com sucesso'], 201);
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
            $artista =  $this->artista->find($request->id);
            if (!$artista) {
                return response()->json(['id' => 'Artista não encontrado!'], 404);
            }
            $artista->delete();
            return response()->json(['ok' => 'Artista' . $artista->name . ' Deletado com sucesso'], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json($e->getMessage(), 500);
            }
            return response()->json('Erro ao deletar', 500);
        }
    }
}
