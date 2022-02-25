<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //edit user data
    public function editUser(User $user,Request $request)
    {         
       
        //validate user details
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phonenumber' => 'required|regex:(^07)|digits:10',
            'country' => ['required', 'string','max:255'],
            'town' => ['required', 'string','max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        //get the form data
        $data = $request->all();
        
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->phonenumber = $data['phonenumber'];
        $user->country = Hash::make($data['country']);
        $user->town = $data['town'];
        $user->password = $data['password'];
        $user->save();

        session()->flash('success','User Edited successfully');
        return redirect('/myprofile');


    }
}
