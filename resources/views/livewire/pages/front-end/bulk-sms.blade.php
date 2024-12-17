<?php

use App\Models\RewardSetting;
use App\Models\User;
use App\Models\UserAudit;
use App\Models\UserAward;
use App\Notifications\AccountActivation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public $recipients = '';
    public $message = '';

    protected $rules = [
        'recipients' => 'required|string',
        'message' => 'required|string|max:160',
    ];

    public function send()
    {
        $this->validate();

        // Format the phone numbers: Replace '0' with '254' if the number starts with '0'
        $recipientsArray = explode(',', str_replace(' ', '', $this->recipients));

        // Loop through each number and format it
        foreach ($recipientsArray as $index => $phone) {
            if (substr($phone, 0, 1) === '0') {
                $recipientsArray[$index] = '254' . substr($phone, 1); // Replace 0 with 254
            }
        }

        try {
            // Send the request with the correct phoneNumbers format as an array
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'apiKey' => 'atsk_83468fc20d90ac438f3547ec5d18d96691cfb0b9d0d3c719ff67be6d1fb43608c1a07317',
            ])->post('https://api.africastalking.com/version1/messaging/bulk', [
                'username' => 'autoshow',
                'message' => $this->message,
                'senderId' => 'PALSAVVY',
                'phoneNumbers' => $recipientsArray, // Use the array format here
            ]);

            if ($response->successful()) {
                $this->alert('success', 'SMS was sent successfully.');
                Log::info($response->body());
            } else {
                $this->alert('error', 'Failed to send message: ' . $response->body());
            }
        } catch (\Exception $e) {
            $this->alert('error', 'There was an error while sending SMS: ' . $e->getMessage());
        }
    }

} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img" alt="Banner">
        <div id="inner-container">
            <livewire:layout.front-end.logo-branding/>
            <livewire:layout.front-end.nav/>
            <div id="title-inner">Send Bulk SMS</div>
        </div><!-- End of inner-container -->
    </div> <!-- End of banner-in -->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <form wire:submit="send">
                    <div class="row g-8">
                        <div class="mb-4 col-12">
                            <label for="recipients" class="form-label font-weight-bold mb-2">Recipients
                                (Comma-separated):</label>
                            <input type="text" class="form-control" id="recipients" wire:model="recipients"
                                   placeholder="0786768567,0786765456"/>
                            @error('recipients') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4 col-12">
                            <label for="message" class="form-label font-weight-bold mb-2">Message:</label>
                            <textarea class="form-control" id="message" rows="4" wire:model="message"
                                      placeholder="Type your message here"></textarea>
                            @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-md btn-outline-success">Send SMS</button>
                        </div>
                    </div>
                </form>
            </div> <!-- End of page-contents -->
        </div> <!-- End of container -->
    </div> <!-- End of wrapper-inner -->

    <div id="newsletter-wrap">
        <div id="container">
            <img src="front-end/images/news-line.jpg" class="news-line">
            <h1>SIGN UP FOR AUTO SHOW ALERTS</h1>
            <h2>Sign up to recieve exclusive tickets offers,show info,awards etc.</h2>
            <form id="newsletter">
                <input type="email" id="newsInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address">
                <button type="submit" class="btn btn-primary">SIGN UP</button>
            </form>
        </div> <!--==end of <div id="container">==-->
    </div> <!-- End of newsletter-wrap -->
</div>
