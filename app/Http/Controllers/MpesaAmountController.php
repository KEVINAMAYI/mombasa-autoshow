<?php

namespace App\Http\Controllers;

use App\Models\MpesaAmount;
use Illuminate\Http\Request;

class MpesaAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        //validate dealer details
        $request->validate([
            'amount' => ['required', 'integer']
        ]);

        $amount = $request->amount;

        //set mpesa amount
        MpesaAmount::where('id', 1 )->update(['amount' =>  $amount]);

        session()->flash('success','Mpesa Amount updated successfully');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MpesaAmount  $mpesaAmount
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $mpesaAmount = MpesaAmount::all();

        return view('admin.mpesa-amount')->with(['MpesaAmount' => $mpesaAmount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MpesaAmount  $mpesaAmount
     * @return \Illuminate\Http\Response
     */
    public function edit(MpesaAmount $mpesaAmount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MpesaAmount  $mpesaAmount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MpesaAmount $mpesaAmount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MpesaAmount  $mpesaAmount
     * @return \Illuminate\Http\Response
     */
    public function destroy(MpesaAmount $mpesaAmount)
    {
        //
    }
}
