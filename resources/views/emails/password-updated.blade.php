@extends('emails.layout',['title' => 'Password Updated', 'userName' => $useName ])

@section('content')
    <p>Your password has been successfully updated. If this wasn't you, please contact our support team immediately.</p>
@endsection
