@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'My Dealers'])

<div id="wrapper-inner">
<div id="container">

   {{-- display success message on a successful action --}}
   @if(Session::has('success'))
   <div style="width:95%; margin:auto" class="alert alert-success" role="alert">
     {{ Session::get('success') }}
   </div>
   @endif


	<div id="page-contents">
    <div style="width:100%; float:left;"><a href="/create-dealer" class="btn2">Submit a Dealer</a></div>
    <h3 class="title2">MY DEALERS</h3>
    
    @foreach ($Dealers as $Dealer)
   
    @if($voted)
      <div id="car-wrap">
    	<a href="/dealer-details/{{ $Dealer->id }}"><img src="images/{{ $Dealer->logo_url }}" class="car-thumb" /></a>
        <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><a href="/dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
            </tr>
            <tr>
              <td>{{ $Dealer->phonenumber}}</td>
              <td>{{ $Dealer->location }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $Dealer->votes }}</strong></td>
            </tr>
              @if( $Dealer->published == 'YES')
                <tr>
                  <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                  <td><a  href="/unpublish-dealer/{{ $Dealer->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
                  <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                </tr>
                <tr>
                  <td ><a style="width:84%;" href="/edit-dealer/{{ $Dealer->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                  <td><a style="width:84%;" href="/delete-dealer/{{ $Dealer->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
                </tr>
              @else
              <tr>
                <td><a href="/publish-dealer/{{$Dealer->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              <tr>
                <td ><a style="width:84%;" href="/edit-dealer/{{  $Dealer->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                <td><a style="width:84%;" href="/delete-dealer/{{  $Dealer->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
              </tr>
              @endif
          </tbody>
        </table>
    </div> <!--==end of <div id="car-wrap">==-->
    @else
    <div id="car-wrap">
    	<a href="/dealer-details/{{ $Dealer->id }}"><img src="images/{{ $Dealer->logo_url }}" class="car-thumb" /></a>
        <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><a href="/dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
            </tr>
            <tr>
              <td>{{ $Dealer->phonenumber}}</td>
              <td>{{ $Dealer->location }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $Dealer->votes }}</strong></td>
            </tr>
            @if( $Dealer->published == 'YES')
              <tr>
                <td><a href="/vote-for-mydealer/{{ $Dealer->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                <td><a  href="/unpublish-dealer/{{ $Dealer->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              <tr>
                <td ><a style="width:84%;" href="/edit-dealer/{{  $Dealer->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                <td><a style="width:84%;" href="/delete-dealer/{{  $Dealer->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
              </tr>
            @else
            <tr>
              <td><a href="/publish-dealer/{{$Dealer->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
              <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
            </tr>
            <tr>
              <td ><a style="width:84%;" href="/edit-dealer/{{  $Dealer->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
              <td><a style="width:84%;" href="/delete-dealer/{{  $Dealer->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
            </tr>
            @endif            
          </tbody>
        </table>
    </div> <!--==end of <div id="car-wrap">==-->
    @endif
   @endforeach

   <h3 class="title2">MY VOTES FOR DEALERS</h3>

   @foreach ($DealersVotes as $Dealer)

   <div id="car-wrap">
     <img src="images/{{ $Dealer->logo_url }}" class="car-thumb" />
      <table class="table">
        <tbody>
          <tr>
            <td colspan="2"><strong style="color:purpule; font-weight:bold;">{{ $Dealer->dealername }}</strong></td>
          </tr>
          <tr>
            <td>{{ $Dealer->phonenumber}}</td>
            <td>{{ $Dealer->location }}</td>
          </tr>
          <tr>
            <td>Total votes: </td>
            <td><strong>{{ $Dealer->votes }}</strong></td>
          </tr>         
        </tbody>
      </table>
  </div> <!--==end of <div id="car-wrap">==-->
     
   @endforeach
    
       
</div> <!--==end of <div id="page-contents">==-->

</div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="wrapper-inner">==-->


<div id="newsletter-wrap">
<div id="container">
	<img src="images/news-line.jpg" class="news-line">
	<h1>SIGN UP FOR AUTO SHOW ALERTS</h1>
    <h2>Sign up to recieve exclusive tickets offers,show info,awards etc.</h2>
    <form id="newsletter">
        <input type="email" id="newsInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address">
		<button type="submit" class="btn btn-primary">SIGN UP</button>
    </form>
</div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="newsletter-wrap">==-->

<div id="sponsors">
<div id="container">
	<h1>SPONSORS/PARTNERS</h1>
	<img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
</div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="sponsors">==-->

  @include('layouts.partials.footer')

@endsection