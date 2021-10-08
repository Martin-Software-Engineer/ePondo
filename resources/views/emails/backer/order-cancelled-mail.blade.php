@component('mail::message')
# Greetings from ePondo!

<br>Service Order Cancelled for <b> {{$order_id}}</b><br><br>

Reason for Cancellation : <br>
<span style="text-decoration:underline;">" {{$reason}} "<span><br><br>

Sorry to hear that your Service Order has been cancelled.
You may contact us to discuss any issues or problems encountered 
that lead to the cancellation of service order. Or if you have 
any inquries or concerns that you would like to address. 
You may email us at epondo.co@gmail.com. <br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
