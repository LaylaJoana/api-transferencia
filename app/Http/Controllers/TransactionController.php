<?php

namespace App\Http\Controllers;

use App\Models\Transaction as Transaction;


class TransactionController extends Controller
{

    protected $transaction;

     function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;

    }

    public function index()
    {
        return response()->json($this->transaction->all());
    }

    public function show(int $id)
    {
        return response()->json($this->transaction->find($id));
    }

}
