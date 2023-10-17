<?php

namespace App\Http\Controllers;

use App\Models\Carteira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarteiraController extends Controller
{
    public function listarCarteiras()
    {
        $carteiras = Carteira::all();
        return response()->json($carteiras);
    }

    public function mostrarSaldo($id)
    {
        $carteira = Carteira::find($id);

        if ($carteira) {
            return response()->json($carteira);
        } else {
            return response()->json(['message' => 'Carteira não encontrada'], 404);
        }
    }

    public function criarCarteira(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'saldo' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Dados inválidos'], 400);
        }

        $carteira = Carteira::create($request->all());

        return response()->json(['message' => 'Carteira criada com sucesso'], 201);
    }

}
