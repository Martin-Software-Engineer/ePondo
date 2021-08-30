@component('mail::message')
# Greetings from ePondo!

<br>You have successfully created a Payout Request.<br>

<hr><br>
<h3><strong>Payout Details</strong></h3><br>

Payout Amount : <span style="text-decoration:underline;"> Php {{$amount}} </span><br>
Bank / Paypal Details : <span style="text-decoration:underline;"> {{$details}} </span><br>

Please allow 1-3 business days for processing of payout. We will notify you 
immediately once payout has been completed. Thank you. <br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
