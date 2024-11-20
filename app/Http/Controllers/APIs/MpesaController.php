<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{

    public function confirm_transaction(Request $request)
    {
        $js_code = json_decode($request->getContent(), true);

        Log::info('----- START OF MPESA RESPONSE -----');
        Log::info($js_code);
        Log::info('----- END OF MPESA RESPONSE -----');

        // Create Mpesa transaction entry
        $mpesa_transaction = MpesaTransaction::create([
            'transaction_id' => $js_code['TransID'] ?? null,
            'first_name' => $js_code['FirstName'] ?? null,
            'middle_name' => $js_code['MiddleName'] ?? null,
            'last_name' => $js_code['LastName'] ?? null,
            'account_number' => strtoupper($js_code['BillRefNumber'] ?? ''),
            'amount_paid' => doubleval($js_code['TransAmount'] ?? 0),
            'phone_number' => $js_code['MSISDN'] ?? null,
            'transaction_time' => $js_code['TransTime'] ?? null,
        ]);

        // Determine transaction status based on the amount paid
        $status = $mpesa_transaction->amount_paid >= 1 ? 'completed' : 'incomplete';

        // Attempt to update the transaction record in the database
        Transaction::where('account_number', $mpesa_transaction->account_number)
            ->update([
                'phone_number' => $mpesa_transaction->phone_number,
                'amount' => $mpesa_transaction->amount_paid,
                'transaction_code' => $mpesa_transaction->transaction_id,
                'status' => $status,
            ]);

        // Send a JSON response to indicate that the transaction was received
        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => "Accepted",
        ]);
    }

    public function validate_transaction()
    {
        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => "Accepted",
        ]);
    }
}
