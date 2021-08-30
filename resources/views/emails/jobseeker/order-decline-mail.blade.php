@component('mail::message')
# Greetings from ePondo!

<br>You have Declined Service Order No. <b>{{$order_id}}</b><br><br>

We are sorry to hear that you are not able to accept the service order request. 
If you have any concerns or quesitons please email us at epondo.co@gmail.com. 
We will be more than glad to assist you. Thank you! <br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
