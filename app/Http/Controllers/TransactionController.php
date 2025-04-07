<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotification;

class TransactionController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('transactions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $transaction = Transaction::create($request->all());

        $user = User::find($request->user_id);

        if ($user) {
            Mail::to($user->email)->send(new TransactionNotification($user, $transaction));
        }

        return redirect()->back()->with('success', 'Transaction created successfully and email sent.');
    }
}
