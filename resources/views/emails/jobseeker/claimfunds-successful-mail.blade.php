@component('mail::message')
# Greetings from ePondo!

<br>Successful Transfer of Campaign Funds!<br>

<hr><br>
<h3><strong>Withdraw Campaign Funds Details</strong></h3><br>

Campaign Title : <span style="text-decoration:underline;font-style:italic;"> " {{$campaign}} " </span><br>
Withdraw Amount : <span style="text-decoration:underline;"> {{$amount}} </span><br>
Bank Details : <span style="text-decoration:underline;"> {{$details}} </span><br>
Status : <span style="color:lime;font-weight:bolder;"> Successful </span><br>

Campaign Funds has been successfully transfered to your bank account. 
Please verify with your Bank Account that the Campaign Funds has been successfully transfered. Thank you!<br>

If you have any question or inquries you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent

