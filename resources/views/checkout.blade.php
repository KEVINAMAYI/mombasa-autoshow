@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Checkout'])

<div id="wrapper-inner">
<div id="container">

  {{-- display success message on a successful action --}}
  @if(Session::has('payment-error'))
  <div class="alert alert-danger" role="alert">
    {{ Session::get('payment-error') }}
  </div>
  @endif

	<div id="page-contents">
    @if($payingfor == 'car')
         {{ Session::put('account_number',$account_number) }}
         {{ Session::put('amountpayable',$amountpayable) }}

          <div id="register">
            <form class="row g-3" method="POST" action="/car-payment-status/{{$carid}}">
              @csrf
                <div class="col-md-4">
                  <img src="images/mpesa.png">
                </div>
                <div class="col-md-8">
                  <p>Hi,your car/PSV has been saved successfully but not yet published, in order to publish your car/PSV, follow and complete the following process and it will published, Thanks.</p>
                </div>
                <p>
                  <ul style="margin-left:20px;">
                    <li>Go to Pay Bill on the M-Pesa</li>
                    <li>Business number - 4002487</li>
                    <li>Account Number - <strong>{{ $account_number }}</strong></li>
                    <li>Amount - Kes. <strong>{{ $amountpayable }}</strong></li>
                    <li>Enter your M-Pesa PIN</li>
                    <li>Wait for confirmation.</li>
                  </ul>
                </p>
                <div class="col-12">
                  <button type="submit" class="btn btn-success">Confirm Payment</button>
                </div>
              </form>
          </div> <!--==end of <div id="register">==-->
      
    @else
       {{ Session::put('account_number',$account_number) }}
       {{ Session::put('amountpayable',$amountpayable) }}

          <div id="register">
            <form class="row g-3" method="POST" action="/dealer-payment-status/{{$dealerid}}">
              @csrf
                <div class="col-md-4">
                  <img src="images/mpesa.png">
                </div>
                <div class="col-md-8">
                  <p>Hi, your dealer has been saved successfully but not yet published, in order to publish your dealer, follow and complete the following process and it will published, Thanks.</p>
                </div>
                <p>
                  <ul style="margin-left:20px;">
                    <li>Go to Pay Bill on the M-Pesa</li>
                    <li>Business number - 4002487</li>
                    <li>Account Number - <strong>{{ $account_number }}</strong></li>
                    <li>Amount - Kes. <strong>{{ $amountpayable }}</strong></li>
                    <li>Enter your M-Pesa PIN</li>
                    <li>Wait for confirmation.</li>
                  </ul>
                </p>
                <div class="col-12">
                  <button type="submit" class="btn btn-success">Confirm Payment</button>
                </div>
              </form>
          </div> <!--==end of <div id="register">==-->
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