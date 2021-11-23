@component('mail::message')
# Greetings from ePondo!

<br>Successful Transfer of Service Earnings!<br>

<hr><br>
<h3><strong>Withdraw Service Earnings Details</strong></h3><br>

Withdraw Amount : <span style="text-decoration:underline;"> Php {{$amount}} </span><br>
Bank Details : <span style="text-decoration:underline;"> {{$details}} </span><br>
Status : <span style="color:lime;font-weight:bolder;"> Successful </span><br>

Service Earnings has been successfully transfered to your bank account. 
Verify with your Bank Account that the Service Earnings has been successfully transfered. Thank you!<br>

If you have any question or inquries you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
