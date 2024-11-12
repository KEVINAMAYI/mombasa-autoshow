<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::name('front-end.')->group(function () {
    Volt::route('/', 'pages.front-end.index')
        ->name('index');

    Volt::route('/about', 'pages.front-end.about')
        ->name('about');

    Volt::route('/car-awards', 'pages.front-end.car-awards')
        ->name('car-awards');

    Volt::route('/car-details', 'pages.front-end.car-details')
        ->name('car-details');

    Volt::route('/checkout', 'pages.front-end.checkout')
        ->name('checkout');

    Volt::route('/contactus', 'pages.front-end.contactus')
        ->name('contactus');

    Volt::route('/create-car', 'pages.front-end.create-car')
        ->name('create-car');

    Volt::route('/faqs', 'pages.front-end.faqs')
        ->name('faqs');

    Volt::route('/my-cars', 'pages.front-end.my-cars')
        ->name('my-cars');

    Volt::route('/my-profile', 'pages.front-end.my-profile')
        ->name('my-profile');

    Volt::route('/my-transactions', 'pages.front-end.my-transactions')
        ->name('my-transactions');

    Volt::route('/my-votes', 'pages.front-end.my-votes')
        ->name('my-votes');

    Volt::route('/privacy', 'pages.front-end.privacy')
        ->name('privacy');

    Volt::route('/results', 'pages.front-end.results')
        ->name('results');

    Volt::route('/terms', 'pages.front-end.terms')
        ->name('terms');

    Volt::route('/transactions', 'pages.front-end.transactions')
        ->name('transactions');

    Volt::route('/users', 'pages.front-end.users')
        ->name('users');

    Volt::route('/vote-per-car', 'pages.front-end.vote-per-car')
        ->name('vote-per-car');

    Volt::route('/voting', 'pages.front-end.voting')
        ->name('voting');
});
