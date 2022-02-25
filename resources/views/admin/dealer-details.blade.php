@extends('admin.layouts.dashboard',['mainpage' => 'Dealer of the Year','mainpagelink' => 'admin-dealers','subpage' => 'Dealer of the Year Details']))
@section('title','Dashboard')

@section('content')

<div id="container">
       <div id="page-contents" style="overflow:hidden;">
         <div id="left-col">
            <h3 class="title2">{{ $Dealer->dealername }}</h3>
            <img src="images/{{ $Dealer->logo_url }}" class="d-block w-100" alt="...">
            <!--==============end of carousel =======-->
            <h3 class="title2">What is unique about this dealer?</h3>
            <p>{{ $Dealer->description }}</p>
        </div> <!--==end of <div id="left-col">==-->
        <div id="right-col">
          <h3 class="title2" style="margin-left:7px;" >Dealer Desciption</h3>
            <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><a href="admin-dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
            </tr>
            <tr>
              <td>Location</td>
              <td>{{ $Dealer->location }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $Dealer->votes }}</strong></td>
            </tr>
            <tr>
              <td>Email </td>
              <td>{{ $Dealer->email }}</td>
            </tr>
            <tr>
              <td>Phone </td>
              <td>{{ $Dealer->phonenumber }}</td>
            </tr>
            <tr>
              <td>Votes </td>
              <td>{{ $Dealer->votes }}</td>
            </tr>       
          </tbody>
        </table>
        </div> <!--==end of <div id="right-col">==-->
    </div> <!--==end of <div id="page-contents">==-->

    </div> <!--==end of <div id="container">==-->
@endsection

