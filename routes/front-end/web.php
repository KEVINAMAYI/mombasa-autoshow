<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::name('front-end.')->group(function () {
    Volt::route('/', 'pages.front-end.index')
        ->name('index');

    Volt::route('/about', 'pages.front-end.about')
        ->name('about');

    Volt::route('/car-awards', 'pages.front-end.car-awards')
        ->name('car-awards');

    Volt::route('/car-details/{vehicle}', 'pages.front-end.car-details')
        ->name('car-details');

    Volt::route('/checkout/{vehicle_id}', 'pages.front-end.checkout')
        ->name('checkout');

    Volt::route('/contactus', 'pages.front-end.contactus')
        ->name('contactus');

    //use normal laravel when storing/editing vehicles
    Route::get('/create-car', [CarController::class, 'showForm'])->name('create-car');
    Route::post('/create-car', [CarController::class, 'store'])->name('store-car');

    Volt::route('/faqs', 'pages.front-end.faqs')
        ->name('faqs');

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
