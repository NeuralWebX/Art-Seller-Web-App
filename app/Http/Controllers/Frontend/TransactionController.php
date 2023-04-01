<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function totalUnPaidTransactionForAnArtist()
    {
        $transaction = Transaction::where('author_id', auth()->user()->id)
            ->where('status', 0)
            ->get();
    }
    public function paidTransactionForAnArtist()
    {
        $transaction = Transaction::where('author_id', auth()->user()->id)
            ->where('status', 1)
            ->get();
    }
    public function artistWithDrawMoney(Request $request, $id)
    {
        $request->validate([
            'artist_paid_account_number' => 'required|digits:16|numeric|min:0000000000000000|max:9999999999999999'
        ]);
        $transaction = Transaction::find($id);
        $cardNumber = $request->artist_paid_account_number;
        $chunkedNumber = collect(str_split($cardNumber, 4))->chunk(4)->map(function ($chunk) {
            return implode('', $chunk);
        })->implode('-');
        $transaction->update([
            'artist_paid' => $transaction->artist_payable,
            'artist_paid_account_number' => $chunkedNumber,
            'status' => 1,
            'artist_payable' => 0.00,
        ]);
        alert()->success('Balance transferd to your account');
        return redirect()->route('backend.transaction.totalUnPaidTransactionForAnArtist');
    }
}
