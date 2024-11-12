<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component
{} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">About Event</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">

                <p>At Mombasa Auto Show, we value your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, share, and protect your data when you interact with this platform. By using our services, you agree to the practices described in this policy.</p>

                <strong> 1. Information We Collect</strong>
                <p>To provide you with the best voting experience and ensure fair participation, we may collect the following types of information:</p>
                <ul>
                    <li>Personal Information: This includes your name, phone number, email address, and other contact details provided during the voting process.</li>
                    <li>Payment Information: We collect payment details such as M-Pesa number, credit card information, or other payment methods you use for voting transactions.</li>
                    <li>Voting Data: We keep a record of the votes you cast, including the number of votes, the vehicle you voted for, and the date/time of each vote.</li>
                    <li>Device Information: We may collect information about the device you use to access our website, including IP address, browser type, and operating system.</li>
                    <li>Cookies and Tracking Technologies: We use cookies and similar technologies to enhance your experience, gather usage data, and improve our services.</li>
                </ul>
                <strong>2. How We Use Your Information</strong>
                <p>We use your personal information for the following purposes:</p>
                <ul>
                    <li>Processing Votes: To record and count your votes accurately and ensure a fair voting process.</li>
                    <li>Prize Distribution: To contact winners of the weekly cash prizes and facilitate prize distribution.</li>
                    <li>Communication: To send you notifications, updates, and marketing messages related to the voting platform, unless you opt out of such communications.</li>
                    <li>Website Improvement: To analyze user behavior and preferences to enhance the functionality and user experience of our website.</li>
                    <li>Fraud Prevention: To detect and prevent fraudulent activities, including vote manipulation and unauthorized access.</li>
                </ul>

                <strong> 3. How We Share Your Information</strong>
                <p>Your privacy is important to us, and we do not sell your personal information. We may share your data only in the following circumstances:</p>
                <ul>
                    <li>Service Providers: We may share your information with trusted third-party service providers who assist us in processing payments, managing data, and conducting the weekly prize draws. These providers are obligated to protect your information and use it only for the specified purposes.</li>
                    <li>Legal Compliance: We may disclose your personal information if required by law or in response to a legal request, such as a court order, government investigation, or as otherwise mandated by applicable laws.</li>
                    <li>Business Transfers: In the event of a merger, acquisition, or sale of assets, your personal information may be transferred to the new entity as part of the transaction.</li>
                </ul>

                <strong> 4. Data Security</strong>
                <p>We implement robust security measures to protect your personal information from unauthorized access, disclosure, or misuse. These include:</p>
                <ul>
                    <li>Encryption: Payment data and sensitive information are encrypted during transmission to ensure secure processing.</li>
                    <li>Access Controls: Only authorized personnel have access to your personal information, and they are required to maintain its confidentiality.</li>
                    <li>Regular Audits: We conduct regular security audits and assessments to identify and address potential vulnerabilities.</li>
                </ul>
                <p>Despite our efforts, please be aware that no method of online transmission or storage is completely secure. We cannot guarantee absolute security, but we strive to use the best practices to protect your data.</p>

                <strong> 5. Your Data Rights</strong>
                <p>You have certain rights regarding your personal information:</p>
                <ul>
                    <li>Access and Correction: You can request access to your personal data and ask for corrections if the information is inaccurate or outdated.</li>
                    <li>Deletion: You can request the deletion of your personal information from our systems, subject to legal and operational requirements.</li>
                    <li>Opt-Out: You can choose to opt out of receiving promotional communications from us by following the unsubscribe instructions provided in the messages or by contacting our support team.</li>
                    <li>Data Portability: You have the right to request a copy of your personal information in a commonly used format.</li>
                </ul>
                <p>To exercise any of these rights, please contact us at <strong>info@mombasaautoshow.com</strong></p>

                <strong> 6. Cookies and Tracking Technologies </strong>
                <p>We use cookies and similar technologies to:</p>
                <ul>
                    <li> Enhance your user experience by remembering your preferences.</li>
                    <li> Analyze website traffic and usage patterns to improve our services.</li>
                    <li> Serve personalized content and advertisements.</li>
                </ul>
                <p>You can manage your cookie preferences through your browser settings. However, disabling cookies may affect the functionality of the website.</p>

                <strong> 7. Third-Party Links </strong>
                <p>Our website may contain links to third-party websites or services. Please note that we are not responsible for the privacy practices or content of these external sites. We encourage you to review the privacy policies of any third-party sites you visit.</p>

                <strong> 8. Changes to This Privacy Policy</strong>
                <p>We reserve the right to update or modify this Privacy Policy at any time. Any changes will be posted on this page, and the "Last Updated" date will be revised accordingly. We encourage you to review this policy regularly to stay informed about how we protect your information.</p>

                <strong> 9. Children’s Privacy</strong>
                <p>Our services are not intended for children under the age of 18. We do not knowingly collect personal information from children. If we discover that we have inadvertently collected data from a child under 18, we will take steps to delete it promptly.</p>

                <strong> 10. Contact Us </strong>
                <p>If you have any questions, concerns, or requests regarding this Privacy Policy or your personal information, please contact us at: <strong>info@mombasaautoshow.com</strong></p>

                <p>By using our website and participating in the voting process, you acknowledge that you have read, understood, and agree to the terms outlined in this Privacy Policy.</p>


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
