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
            'usuario_id' => 'required|exists:users,id',
            'saldo' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Dados inválidos'], 400);
        }

        $carteira = Carteira::create($request->all());

        return response()->json(['message' => 'Carteira criada com sucesso'], 201);
    }

    public function transferir(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'remetente_id' => 'required|exists:carteiras,id',
            'destinatario_id' => 'required|exists:carteiras,id',
            'valor' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Dados de transferência inválidos'], 400);
        }

        $remetente = Carteira::find($request->remetente_id);
        $destinatario = Carteira::find($request->destinatario_id);

        if (!$remetente || !$destinatario) {
            return response()->json(['message' => 'Carteira do remetente ou destinatário não encontrada'], 404);
        }

        // verifica se quem envia tem saldo
        if ($remetente->saldo < $request->valor) {
            return response()->json(['message' => 'Saldo insuficiente para realizar a transferência'], 400);
        }

        DB::beginTransaction();

        try {
            // atualiza os saldos 
            $remetente->decrement('saldo', $request->valor);
            $destinatario->increment('saldo', $request->valor);
            // aqui confirma a transação
            DB::commit();

            return response()->json(['message' => 'Transferência realizada com sucesso'], 200);
        } catch (\Exception $e) {
            // se não der certo a transação, é retornada a ação
            DB::rollBack();

            return response()->json(['message' => 'Falha na transferência'], 500);
        }
    }

}
