@extends('emails.layout', [
    'title' => 'Verify Your Email',
    'userName' => $userName
    ])
@section('content')
    <p>Thank you for signing up with us! To complete your registration, please verify your email address by clicking the
        button below:</p>
@endsection
