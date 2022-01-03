@component('mail::message')
# Greetings from ePondo!

<br>Unsuccessful Transfer of Service Earnings<br>

<hr><br>
<h3><strong>Withdraw Service Earnings Details</strong></h3><br>

Withdraw Amount : <span style="text-decoration:underline;"> Php {{$amount}} </span><br>
Bank Details : <span style="text-decoration:underline;"> {{$details}} </span><br>
Status : <span style="color:crimson;font-weight:bolder;"> Unsuccessful </span><br>

Unsuccessful Transfer of Service Earnings. ePondo support Team will reach out to you via email 
regarding this, please check your email. You may also directly consult with the support team at 
epondo.co@gmail.com. Thank you!<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
