@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Dealer Details'])

<div id="wrapper-inner">
<div id="container">

  @if (Auth::check())
  @if($voted)
  <div id="page-contents">
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
          <td colspan="2"><a href="dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
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
        @if( $Dealer->published == 'YES')
        <tr>
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
          <td ><a style="width:84%;" href="/edit-dealer/{{ $Dealer->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
          <td><a style="width:84%;" href="/delete-dealer/{{ $Dealer->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
        </tr>
        @endif 
      </tbody>
    </table>
    </div> <!--==end of <div id="right-col">==-->
</div> <!--==end of <div id="page-contents">==-->

  @else
  <div id="page-contents">
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
          <td colspan="2"><a href="dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
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
        @if( $Dealer->published == 'YES')
        <tr>
          <tr>
            <td><a href="/vote-for-dealer-on-display/{{ $Dealer->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
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
          <td ><a style="width:84%;" href="/edit-dealer/{{ $Dealer->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
          <td><a style="width:84%;" href="/delete-dealer/{{ $Dealer->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
        </tr>
        @endif         
      </tbody>
    </table>
    </div> <!--==end of <div id="right-col">==-->
</div> <!--==end of <div id="page-contents">==-->
    
  @endif
  
  {{-- user not logged in --}}
  @else

  <div id="page-contents">
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
          <td colspan="2"><a href="dealer-details/{{ $Dealer->id }}" class="title3"><strong>{{ $Dealer->dealername }}</strong></a></td>
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
        @if( $Dealer->published == 'YES')
        <tr>
          <tr>
            <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
          </tr>
          @else
        <tr>
          <td><a href="/publish-dealer/{{$Dealer->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @endif         
      </tbody>
    </table>
    </div> <!--==end of <div id="right-col">==-->
</div> <!--==end of <div id="page-contents">==-->

  @endif

	

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

  @include('layouts.partials.footer')

@endsection