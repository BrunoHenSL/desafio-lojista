<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransferenciaController extends Controller
{
    public function transferirDinheiro(Request $request)
    {
        $remetente = User::findOrFail($request->remetente_id);
        $destinatario = User::findOrFail($request->destinatario_id);

        //verifica se quem envia tem saldo suficiente, caso contrário dá como insuficiente
        if ($remetente->carteira->balance < $request->amount) {
            return response()->json(['message' => 'Saldo insuficiente'], 400);
        }

        //atualiza o saldo das carteiras
        $remetente->carteira->decrement('balance', $request->amount);
        $destinatario->carteira->increment('balance', $request->amount);

        return response()->json(['message' => 'Transferência realizada com sucesso'], 200);
    }
}
