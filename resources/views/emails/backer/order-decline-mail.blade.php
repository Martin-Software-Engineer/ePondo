@component('mail::message')
# Greetings from ePondo!

<br>Your Service Order Request with No. <b>{{$order_id}}</b> has been Declined.<br><br>

Reason for Declining Request : <br>
<span style="text-decoration:underline;">" {{$reason}} "<span><br><br>

We are sorry to hear that your service order request has been declined. 
If you have any concerns or quesitons please email us at epondo.co@gmail.com. 
We will be more than glad to assist you. Thank you! <br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
