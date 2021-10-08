@component('mail::message')
# Greetings from ePondo!

<br>Successful Transfer of Payout!<br>

<hr><br>
<h3><strong>Payout Details</strong></h3><br>

Payout Amount : <span style="text-decoration:underline;"> {{$amount}} </span><br>
Bank Details : <span style="text-decoration:underline;"> {{$details}} </span><br>
Status : <span style="color:lime;font-weight:bolder;"> Successful </span><br>

Payout amount has been successfully transfered to your bank account. 
Verify with your Bank Account that the Payout Amount has been successfully transfered. Thank you!<br>

If you have any question or inquries you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
