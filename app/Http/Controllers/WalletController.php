<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class WalletController extends Controller
{

    protected $wallet;
    protected $user;
    protected $transaction;

    function __construct(Wallet $wallet, User $user, Transaction $transaction)
    {

        $this->wallet = $wallet;
        $this->user = $user;
        $this->transaction = $transaction;
    }

    public function index()
    {

        return response()->json($this->wallet->all());
    }

    function show(int $id)
    {
        $data = $this->wallet->find($id);

        if (empty($data)) return response()->json(['messege' => 'unregistered wallet'], 404);

        return response()->json($data);
    }
    
    function transfer(Request $request)
    {
        $this->validate($request, [
            'id_user_from' => 'required|integer',
            'id_user_to' => 'required|integer',
            'value' => 'required|numeric|min:0.01'
        ]);

        if ($request->id_user_from == $request->id_user_to) {
            return response()->json(['message' => 'It was not possible to make a transfer to the wallet itself'], 401);
        }
        $walletDataFrom = $this->wallet->find($request->id_user_from);
        $walletDataTo = $this->wallet->find($request->id_user_to);

        if (!$walletDataFrom || !$walletDataTo) return response()->json(['message' => 'User not found'], 404);

        $user = $this->user->find($request->id_user_from);

        if (($user->type) != 'comum') return response()->json(['message' => 'user without permission to transfer'], 401);

        if ($walletDataFrom->balance < $request->value) return response()->json(['message' => 'insufficient funds'], 401);

        DB::beginTransaction();
        try {
            $walletDataFrom->balance -= $request->value;
            $walletDataTo->balance += $request->value;
            $this->wallet->updateWallet($request->id_user_from,$walletDataFrom->balance);
            $this->wallet->updateWallet($request->id_user_to,$walletDataTo->balance);

            $this->transaction->create([
                'id_user_from' => $request->id_user_from,
                'id_user_to' => $request->id_user_to,
                'value' => $request->value
            ]);

            DB::commit();
            return response()->json('transfer successfully',201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Unable to transfer'], 500);
        }
    }

    function deposit(Request $request)
    {
        $this->validate($request, ['id_user' => 'required|integer', 'balance' => 'required|numeric|min:0.01']);
        $walletData = $this->wallet->find($request->id_user);

        if (!$walletData) return response()->json(['message' => 'wallet not found'], 404);

        DB::beginTransaction();
        try {
            $walletData->balance += $request->balance;
            $this->wallet->updateWallet($request->id_user, $walletData->balance);
            $this->transaction->create([
                'id_user_to' => $request->id_user,
                'value' => $request->balance
            ]);
            DB::commit();
            return response()->json('Deposit successfully',201);
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return response()->json(['message' => 'Oops, there was an error with your deposit'], 500);
        }
    }


    function delete($id)
    {
        $data = $this->wallet->find($id);
        if (empty($data)) return response()->json(['messege' => 'wallet not found'], 404);
        if ($data) $this->wallet->deleteById($id);
        return response()->json($data);
    }
}
