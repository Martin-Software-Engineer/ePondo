@component('mail::message')
# Greetings from ePondo!

<br>You have successfully created a Payout Request.<br>

<hr><br>
<h3><strong>Payout Details</strong></h3><br>

Payout Amount : <span style="text-decoration:underline;"> XXX </span><br>
Bank / Paypal Details : <span style="text-decoration:underline;"> XXX </span><br>

Please review the Payout Details to successfully process payouts. Thank you. <br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
