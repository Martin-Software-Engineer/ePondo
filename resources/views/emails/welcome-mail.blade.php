@component('mail::message')
# Welcome to ePondo!

You've successfully created an account. Thank you for joining us at ePondo, 
we are glad to have you be a part of this community.

Before you get started, please verify your email first, through the verificaiton
email we sent you. You need only to click the "Verify Email Address" button and 
log-in to your account to fully verify your email.

Best regards,<br>
{{ config('app.name') }}
@endcomponent
