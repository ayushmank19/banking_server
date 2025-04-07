<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Transaction;

class TransactionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $transaction;

    public function __construct(User $user, Transaction $transaction)
    {
        $this->user = $user;
        $this->transaction = $transaction;
    }

    public function build()
    {
        return $this->markdown('emails.transaction')
                    ->with([
                        'user' => $this->user,
                        'transaction' => $this->transaction,
                    ]);
    }
}
