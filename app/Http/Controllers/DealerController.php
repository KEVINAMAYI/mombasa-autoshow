<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Dealer;
use App\Models\DealersVote;
use App\Models\MpesaAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class DealerController extends Controller
{
    public function uploadDealer(Dealer $dealer,Request $request)
    {



        Session::put('dealername',$request->dealername);
        Session::put('location',$request->location);
        Session::put('email',$request->email);
        Session::put('phonenumber',$request->phonenumber);
        Session::put('description',$request->description);

        //validate dealer details
        $request->validate([
            'dealername' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phonenumber' => 'required|regex:(^07)|digits:10',
            'description' => ['required', 'string','max:255'],
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048']);


        
         $data = $request->all();
        
         //create a new image using current timestamp username and file extension
         $newImageName =time() . '-' . str_replace(' ','',$data['dealername']) . '.'. $request->logo->extension();
        
         //move image to the user_image folder in public directory
         $request->logo->move(public_path('images'),$newImageName);
         
         $dealer->user_id = auth()->user()->id;
         $dealer->dealername = $data['dealername'];
         $dealer->location = $data['location'];
         $dealer->email = $data['email'];
         $dealer->phonenumber = $data['phonenumber'];
         $dealer->description = $data['description'];
         $dealer->logo_url =  $newImageName;
         $dealer->votes = 0;
         $dealer->published = 'NO';
         $dealer->save(); 
      
         $account_number = $this->generateAccountNumber();
         $amountpayable = MpesaAmount::all()[0]['amount'];

         return view('/checkout')->with(['payingfor' => 'dealer','dealerid' => $dealer['id'],'account_number' => $account_number,'amountpayable' => $amountpayable]);

    }

    public function updateDealer(Dealer $dealer,Request $request)
    {


        //validate dealer details
        $request->validate([
            'dealername' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phonenumber' => 'required|regex:(^07)|digits:10',
            'description' => ['required', 'string']
        ]);


        
         $data = $request->all();

         if(($request->hasfile('logo')) && ($request->logo != null))
         {
            
              //create a new image using current timestamp username and file extension
              $newImageName =time() . '-' . str_replace(' ','',$data['dealername']) . '.'. $request->logo->extension();
            
              //move image to the user_image folder in public directory
              $request->logo->move(public_path('images'),$newImageName);

              Dealer::where('id','=',$dealer['id'])->update([
                'user_id' => auth()->user()->id,
                'dealername' => $data['dealername'],
                'location' => $data['location'],
                'email' => $data['email'],
                'phonenumber' => $data['phonenumber'],
                'description' => $data['description'],
                'logo_url' =>  $newImageName


              ]);

         }
         else{

            Dealer::where('id','=',$dealer['id'])->update([
                'user_id' => auth()->user()->id,
                'dealername' => $data['dealername'],
                'location' => $data['location'],
                'email' => $data['email'],
                'phonenumber' => $data['phonenumber'],
                'description' => $data['description']

              ]);


         }
        
         session()->flash('success','Dealer Updated successfully');
         return redirect('/mydealers');
    }


    //Return cars with label PSV of the year
    public function getDealers()
    {
        $user_id = auth()->user()->id;
        $userDealerVote = DealersVote::where('user_id','=',$user_id)->get();
        $voted = !($userDealerVote->isEmpty());
        $Dealers = Dealer::where('user_id','=',$user_id)->orderBy('votes', 'DESC')->get();
        $DealersVotes = Dealer::where([['user_id','=',$user_id],
                                      ['votes','>',0]])->orderBy('votes', 'DESC')->get();

        return view('mydealers')->with(['Dealers' => $Dealers,'voted' => $voted, 'DealersVotes' => $DealersVotes ]);
    }

    //getDealer
    public function getDealer(Dealer $dealer)
    { 
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $userDealerVote = DealersVote::where('user_id','=',$user_id)->get();
            $voted = !($userDealerVote->isEmpty());
            return view('dealer-details')->with(['Dealer' => $dealer,'voted' => $voted]);

        }
        else
        {
            return view('dealer-details')->with(['Dealer' => $dealer]);


        }
       
    }

    //Return dealers to vote for --> If the user has voted the button for voting will be greyed out
    public function getDealersOfTheYearToVoteFor()
    {   
        if(Auth::check())
        {

            $user_id = auth()->user()->id;
            $userDealerVote = DealersVote::where('user_id','=',$user_id)->get();
            $voted = !($userDealerVote->isEmpty());
            $Dealers = Dealer::where('published','=','YES')->orderBy('votes', 'DESC')->get();
            return view('dealer-awards')->with(['Dealers' => $Dealers, 'voted' => $voted]);
        }
        else
        {

            $Dealers = Dealer::where('published','=','YES')->orderBy('votes', 'DESC')->get();
            return view('dealer-awards')->with('Dealers',$Dealers);
     
        }
    }


    //Return dealers to vote for --> If the user has voted the button for voting will be greyed out
    public function searchDealer(Request $request)
    {   
        $searchquery = $request->searchquery;

        if(Auth::check())
        {

            $user_id = auth()->user()->id;
            $userDealerVote = DealersVote::where('user_id','=',$user_id)->get();
            $voted = !($userDealerVote->isEmpty());
            $Dealers = Dealer::where('published','=','YES')
                                ->where(function($query) use ($searchquery)
                                {
                                    $query->orWhere('location','LIKE',"%{$searchquery}%")
                                    ->orWhere('email','LIKE',"%{$searchquery}%")
                                    ->orWhere('phonenumber','LIKE',"%{$searchquery}%")
                                    ->orWhere('description','LIKE',"%{$searchquery}%")
                                    ->orderBy('votes', 'DESC');

                                })->get();            
            return response()->json([
                'dealers' => $Dealers,
                'voted' => $voted,
                'loggedin' => true
            ]);
        }
        else
        {

            $Dealers = Dealer::where('published','=','YES')
                                ->where(function($query) use ($searchquery)
                                {
                                    $query->orWhere('location','LIKE',"%{$searchquery}%")
                                    ->orWhere('email','LIKE',"%{$searchquery}%")
                                    ->orWhere('phonenumber','LIKE',"%{$searchquery}%")
                                    ->orWhere('description','LIKE',"%{$searchquery}%")
                                    ->orderBy('votes', 'DESC');

                                })->get();  
            return response()->json([
                'dealers' => $Dealers,
                'loggedin' => false
            ]);
     
        }
    }


    //publish dealer
    public function getDealertoPublish(Dealer $dealer)
    {
       
        $account_number = $this->generateAccountNumber();
        $amountpayable = MpesaAmount::all()[0]['amount'];
        return view('/checkout')->with(['payingfor' => 'dealer','dealerid' => $dealer['id'],'account_number' => $account_number,'amountpayable' =>  $amountpayable]);


    }


    //admin get dealers
    public function adminDealers()
    {   
        $dealers = Dealer::orderBy('votes', 'DESC')->get();        ;
        return view('admin.dealers')->with(['dealers' => $dealers ]);
    }


    private function generateAccountNumber()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $shuffled_letters = str_shuffle($letters);
        $shuffled_numbers = str_shuffle($numbers);
        $ref_number = substr($shuffled_letters, 0, 1).substr($shuffled_numbers, 0, 4);
        return $ref_number;
    }


    public function getAdminDealerDetails(Dealer $Dealer)
    {
        return view('admin.dealer-details')->with(['Dealer' => $Dealer ]);

    }

    public function deleteDealer(Dealer $dealer)
    {

        $dealer->delete();
        DealersVote::where('dealer_id','=',$dealer['id'])->delete();
        session()->flash('success','Dealer deleted successfully');
        return redirect('/mydealers');
        
    }

    public function publishDealer(Dealer $dealer)
    {

        $dealer->update(['published' => 'YES']);
        session()->flash('success','Dealer published successfully');
        return redirect()->back();
        
    }

    public function unpublishDealer(Dealer $dealer)
    {

        $dealer->update(['published' => 'NO']);
        session()->flash('success','Dealer unpublished successfully');
        return redirect()->back();
        
    }

    //edit dealerpage
    public function editDealer(Dealer $dealer)
    {

        return view('/edit-dealer')->with(['dealer' => $dealer]);

    }



}
