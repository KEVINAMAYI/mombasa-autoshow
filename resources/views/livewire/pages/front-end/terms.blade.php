<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component
{} ?>

<div>
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Terms and Conditions</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">

                <p>Welcome to the <strong>Mombasa Auto Show Platform</strong>. Please read the following Terms and Conditions carefully before participating in the voting process. By casting your vote, you agree to comply with and be bound by these terms. If you do not agree with any part of these terms, please refrain from participating.</p>

                <strong>1.Eligibility</strong>
                <ul>
                    <li>- You must be 18 years or older to participate in the voting process.</li>
                    <li>- Voting is open to residents of Kenya and any other eligible participants as specified on the website.</li>
                    <li>- By participating, you confirm that all the information you provide is accurate and that you are eligible to vote.</li>
                </ul>
                <strong>2. Voting Process </strong>
                <ul>
                    <li>- Each vote costs <strong>Ksh. 50</strong>, which will be deducted from your selected payment method (e.g., M-Pesa, credit card, or any other approved payment option).</li>
                    <li>- You can vote as many times as you wish. There are no restrictions on the number of votes you can cast.</li>
                    <li>- For every <strong>Ksh. 50</strong> spent, you will earn <strong>one vote</strong>. For instance, if you spend Ksh. 100, you will receive <strong>2 votes</strong>.</li>
                </ul>
                <strong> 3. Chance to Win Prizes </strong>
                <ul>
                    <li>- Each vote you cast enters you into a weekly draw where you stand a chance to win exciting cash prizes.</li>
                    <li>- The more votes you cast, the higher your chances of winning in the weekly draws.</li>
                    <li>- Winners will be selected at random from the pool of voters for the week.</li>
                    <li>- The winners will be notified via the contact details provided during the voting process.</li>
                </ul>

                <strong> 4. Cash Prizes and Reward Distribution </strong>
                <ul>
                    <li>- Cash prizes will be distributed to the winners as per the details provided on the platform.</li>
                    <li>- Winners will be contacted via phone or email within 48 hours of the draw.</li>
                    <li>- If a winner cannot be reached within 7 days, the prize will be forfeited, and a new winner may be selected at the platform's discretion.</li>
                    <li>- Prizes are non-transferable and cannot be exchanged for any other form of compensation.</li>
                </ul>
                <strong> 5. Refund Policy </strong>
                <ul>
                    <li>- All payments made for voting are <strong>non-refundable</strong>, except in cases of error where the payment was duplicated or made without the user's </li>consent.
                    <li>- If you experience any issues with payment, please contact our customer support team immediately.</li>
                </ul>

                <strong> 6. Voting Integrity </strong>
                <ul>
                    <li>- The voting process is designed to be fair and transparent. Any attempt to manipulate the voting system through fraudulent or automated methods is strictly prohibited.</li>
                    <li>- The platform reserves the right to disqualify any participant found to be engaging in unfair practices, including but not limited to:
                        <ul>
                            <li>  - Using bots or automated voting systems.
                            <li>  - Creating multiple accounts for the purpose of casting additional votes.
                            <li>  - Any other form of vote manipulation.
                        </ul>
                    </li>
                </ul>

                <strong> 7. Platform Liability </strong>
                <ul>
                    <li>- The platform does not guarantee that the service will be error-free or uninterrupted. While we strive to provide a seamless experience, technical issues may arise.</li>
                    <li>- The platform is not liable for any losses or damages resulting from:
                        <ul>
                            <li>- Failed or delayed payments.</li>
                            <li>- Technical errors or system outages.</li>
                            <li>- Unauthorized access or use of your account.</li>
                        </ul>
                    </li>
                </ul>
                <strong> 8. Data Privacy</strong>
                <ul>
                    <li>- By participating in the voting process, you agree to provide certain personal information necessary for verification and prize distribution.</li>
                    <li>- We are committed to protecting your personal data in accordance with our Privacy Policy. Your information will not be shared with third parties without your consent, except as required by law.</li>
                    <li>- You may opt out of receiving promotional communications from us at any time by following the instructions provided in the communication.</li>
                </ul>

                <strong> 9. Changes to Terms and Conditions </strong>
                <ul>
                    <li>- The platform reserves the right to modify or update these Terms and Conditions at any time without prior notice.</li>
                    <li>- Any changes will be effective immediately upon posting on the website. It is your responsibility to review the Terms and Conditions regularly to stay informed of any updates.</li>
                </ul>

                <strong> 10. Governing Law</strong>

                <p> These Terms and Conditions are governed by the laws of Kenya. Any disputes arising from or related to the voting process will be subject to the exclusive jurisdiction of the Kenyan courts.</p>

                <strong> 11. Contact Us </strong>
                <p>  If you have any questions or concerns about these Terms and Conditions, please contact our customer support team at <strong>info@mombasaautoshow.com</strong>.

                <p>By participating in the voting process, you acknowledge that you have read, understood, and agree to these Terms and Conditions. Enjoy voting and good luck with the weekly draws!</p>




            </div> <!--==end of <div id="page-contents">==-->

        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="wrapper-inner">==-->


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
    </div> <!--==end of <div id="newsletter-wrap">==-->

</div>
