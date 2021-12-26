@component('mail::message')
# Greetings from ePondo!

<br>You have successfully created a Withdraw Campaign Funds Request.<br>

<hr><br>
<h3><strong>Withdraw Campaign Funds Request Details</strong></h3><br>

Campaign : <span style="text-decoration:underline;font-style:italic;"> "{{$campaign}}" </span><br>
Withdraw Amount : <span style="text-decoration:underline;"> Php {{$amount}} </span><br>
Bank / Paypal Details : <span style="text-decoration:underline;"> {{$details}} </span><br>
Status : <span style="color:darkorange;font-weight:bolder;"> Pending </span><br>

Please allow 1-3 business days for processing. We will notify you 
immediately once processing has been completed. Thank you. <br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
