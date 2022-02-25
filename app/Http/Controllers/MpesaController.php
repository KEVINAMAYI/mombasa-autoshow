<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\Dealer;
use App\Models\MpesaAmount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;




class MpesaController extends Controller
{
   

   //confirm payment using reference number and publish car
   public function checkcarPaymentStatus(Car $car)
   {
       
       $account_number = Session::get('account_number');
       $amountpayable = MpesaAmount::all()[0]['amount'];
       
       Session::put('car_id',$car['id']);
       $transaction = Transaction::where('account_number','=',$account_number)->get();

       //check if transaction exists
       if(empty($transaction[0]))
       {

        $car_id = Session::get('car_id');
        session()->flash('payment-error','Please complete payment and try again');
        return view('/checkout')->with(['payingfor' => 'car','carid' => $car_id,'account_number' => $this->generateAccountNumber(),'amountpayable' => $amountpayable]);


       }
       else
       {


         
         //get the amount only if the transaction exists
         $amount = intval($transaction[0]['amount_paid']);
         $amountpayable = MpesaAmount::all()[0]['amount'];


         if($amount >= $amountpayable )
         {

            $car->update(['published'=>'YES']);
            session()->flash('success','Car published successfully');
            return redirect('/create-car');

         }
         else
         {
            $car_id = Session::get('car_id');
            session()->flash('payment-error','Payment Amount is ' .$amountpayable.', please enter the correct amount !!');
            return view('/checkout')->with(['payingfor' => 'car','carid' => $car_id,'account_number' => $this->generateAccountNumber(),'amountpayable' => $amountpayable]);

         }

        
       }
       
   }

   //confirm payment using reference number and publish dealer
   public function checkdealerPaymentStatus(Dealer $dealer)
   {

    $account_number = Session::get('account_number');
    $amountpayable = Session::get('amountpayable');
    Session::put('dealer_id',$dealer['id']);
    $transaction = Transaction::where('account_number','=',$account_number)->get();

     //check if transaction exists
     if(empty($transaction[0]))
     {

      $dealer_id = Session::get('dealer_id');
      session()->flash('payment-error','Please complete payment and try again');
      return view('/checkout')->with(['payingfor' => 'dealer','dealerid' => $dealer_id,'account_number' => $this->generateAccountNumber(),'amountpayable' => $amountpayable]);


     }
     else
     {

       //get the amount only if the transaction exists
       $amount = intval($transaction[0]['amount_paid']);
       $amountpayable = MpesaAmount::all()[0]['amount'];


       if($amount >= $amountpayable)
       {

            $dealer->update(['published'=>'YES']);
            session()->flash('success','Dealer published successfully');
            return redirect('/create-dealer');

       }
       else
       {
          $dealer_id = Session::get('dealer_id');
          session()->flash('payment-error','Payment Amount is ' .$amountpayable.', please enter the correct amount !!');
          return view('/checkout')->with(['payingfor' => 'dealer','dealerid' => $dealer_id,'account_number' => $this->generateAccountNumber(),'amountpayable' => $amountpayable]);

       }

      
     }

   }


   //get mpesa confirmation and store payment details in the db.
   public function mpesaConfirmation(Request $request)
   {    
        //get transaction data from the post request
        $js_code = json_decode($request->getContent(),true);   
        
        //store transaction data in db
        Transaction::create([
            'transaction_id'   => $js_code['TransID'],
            'first_name'       => $js_code['FirstName'],
            'middle_name'      => $js_code['MiddleName'],
            'last_name'        => $js_code['LastName'],
            'account_number'   => strtoupper ($js_code['BillRefNumber']),
            'amount_paid'      => $js_code['TransAmount'],
            'phone_number'     => $js_code['MSISDN'],
            'transaction_time' => $js_code['TransTime'],

        ]);

      //sent a json response to show that transaction was successful
      return  response()->json([
                'ResultCode' => 0,
                'ResultDesc' => "Accepted",
            ]);
    
        
   }


    // validate payment
    public function mpesaValidation (Request $request)
    {
          $js_code = json_decode($request->getContent(),true);  

           //get the amount only if the transaction exists
           $amount = intval($js_code['TransAmount']);

            if($amount >= 1000)
            { 

                 //sent a json response to show that transaction was successful
                  return  response()->json([
                    'ResultCode' => 0,
                    'ResultDesc' => "Accepted",
                ]);

            }
            else
            {

                   //sent a json response to show that transaction was successful
                    return  response()->json([
                      'ResultCode' => 0,
                      'ResultDesc' => "Rejected",
                  ]);


            }




    }

    //generate new account number
    private function generateAccountNumber()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $shuffled_letters = str_shuffle($letters);
        $shuffled_numbers = str_shuffle($numbers);
        $ref_number = substr($shuffled_letters, 0, 1).substr($shuffled_numbers, 0, 4);
        return $ref_number;
    }




}
