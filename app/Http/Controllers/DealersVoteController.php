<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\DealersVote;


class DealersVoteController extends Controller
{
    //store users vote to the DB
    public function voteForDealerOnPublic(Dealer $dealer)
    {
       
        $dealer_id = $dealer->id;
        $user_id = auth()->user()->id;

        DealersVote::create([
            'user_id' => $user_id,
            'dealer_id' => $dealer_id
        ]);

        $newdealervotes = (Dealer::where('id', $dealer_id )->get()[0]['votes'])+1;
        Dealer::where('id', $dealer_id )->update(['votes' => $newdealervotes]);

        return redirect('/dealer-awards');

    }

     //store users vote to the DB
     public function voteForDealerOnPrivate(Dealer $dealer)
     {
        
         $dealer_id = $dealer->id;
         $user_id = auth()->user()->id;
 
         DealersVote::create([
             'user_id' => $user_id,
             'dealer_id' => $dealer_id
         ]);

        $newdealervotes = (Dealer::where('id', $dealer_id )->get()[0]['votes'])+1;
        Dealer::where('id', $dealer_id )->update(['votes' => $newdealervotes]);
 
         return redirect('/mydealers');
 
     }

      //store users vote to the DB
      public function voteForDealerOnDisplay(Dealer $dealer)
      {
         
          $dealer_id = $dealer->id;
          $user_id = auth()->user()->id;
  
          DealersVote::create([
              'user_id' => $user_id,
              'dealer_id' => $dealer_id
          ]);
          
        $newdealervotes = (Dealer::where('id', $dealer_id )->get()[0]['votes'])+1;
        Dealer::where('id', $dealer_id )->update(['votes' => $newdealervotes]);

          return redirect("/dealer-details/{$dealer_id}");
  
      }
}
