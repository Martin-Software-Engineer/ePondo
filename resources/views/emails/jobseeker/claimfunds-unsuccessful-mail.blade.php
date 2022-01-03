@component('mail::message')
# Greetings from ePondo!

<br>Unsuccessful Transfer of Campaign Funds<br>

<hr><br>
<h3><strong>Withdraw Campaign Funds Details</strong></h3><br>

Campaign Title : <span style="text-decoration:underline;font-style:italic;"> " {{$campaign}} " </span><br>
Withdraw Amount : <span style="text-decoration:underline;"> {{$amount}} </span><br>
Bank Details : <span style="text-decoration:underline;"> {{$details}} </span><br>
Status : <span style="color:crimson;font-weight:bolder;"> Unsuccessful </span><br>

Unsuccessful Transfer of Campaign Funds. ePondo support Team will reach out to you via email 
regarding this, please check your email. You may also directly consult with the support team at 
epondo.co@gmail.com. Thank you!<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent

