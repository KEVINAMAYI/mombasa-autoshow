@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Dealer of the Year'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">
    <p>The Mombasa Autoshow dealer awards aim to celebrate and honor those car dealers with exemplary services and innovations that have paved the way for the future of these sectors and set benchmarks in their respective fields while helping Kenyans make better decisions when buying cars. The car dealers are invited to submit their company details for voting. Winners of the competition will receive cash prize,trophies and many more giveaways.</p>    
    <div class="row g-3">
      <div class="col-sm-8">
        <input type="text" id="searchdealer" name="searchdealer" class="form-control" placeholder="Search for dealer by any keyword" aria-label="Dealer car">
      </div>
      <div class="col-sm-4">
        <a href="/create-dealer" class="btn2" style="margin-top:0;">Submit a Dealer</a>
      </div>
    </div>
    <!-- =======end of Search====-->

   @if(Auth::check())
   {{-- User is Logged in --}}

   @foreach ( $Dealers as $Dealer )
      
    @if($voted)

    <div id="car-wrap" class="dealer">
    	<a href="dealer-details/{{ $Dealer->id }}"><img src="images/{{ $Dealer->logo_url }}" class="car-thumb" /></a>
        <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><a href="dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
            </tr>
            <tr>
              <td>{{ $Dealer->phonenumber }}</td>
              <td>{{ $Dealer->email }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $Dealer->votes }}</strong></td>
            </tr>
            <tr>
              <td colspan="2"><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
              <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
            </tr>
          </tbody>
        </table>
    </div> <!--==end of <div id="car-wrap">==-->

  @else

  <div id="car-wrap" class="dealer">
    <a href="dealer-details/{{ $Dealer->id }}"><img src="images/{{ $Dealer->logo_url }}" class="car-thumb" /></a>
      <table class="table">
        <tbody>
          <tr>
            <td colspan="2"><a href="dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
          </tr>
          <tr>
            <td>{{ $Dealer->phonenumber }}</td>
            <td>{{ $Dealer->email }}</td>
          </tr>
          <tr>
            <td>Total votes: </td>
            <td><strong>{{ $Dealer->votes }}</strong></td>
          </tr>
          <tr>
            <td colspan="2"><a href="/vote-for-dealer/{{ $Dealer->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
          </tr>
        </tbody>
      </table>
  </div> <!--==end of <div id="car-wrap">==-->
    
  @endif

  @endforeach

  @else

  @foreach ( $Dealers as $Dealer )

  <div id="car-wrap" class="dealer">
    <a href="/dealer-details/{{ $Dealer->id }}"><img src="images/{{ $Dealer->logo_url }}" class="car-thumb" /></a>
      <table class="table">
        <tbody>
          <tr>
            <td colspan="2"><a href="dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
          </tr>
          <tr>
            <td>{{ $Dealer->phonenumber }}</td>
            <td>{{ $Dealer->email }}</td>
          </tr>
          <tr>
            <td>Total votes: </td>
            <td><strong>{{ $Dealer->votes }}</strong></td>
          </tr>
          <tr>
            <td colspan="2"><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
          </tr>
        </tbody>
      </table>
  </div> <!--==end of <div id="car-wrap">==-->

    
  @endforeach
     
  @endif
    
   

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