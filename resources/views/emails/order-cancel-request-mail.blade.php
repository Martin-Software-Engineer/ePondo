@component('mail::message')
# Greetings from ePondo!

<br>You have Cancelled <b>Service Order No. {{$order_id}}</b><br><br>

We are saddened to hear that you cancelled your service order.
Feel free to contact us to discuss any issues and problems encountered 
that lead you to the cancellation of service order. 
You may contact us through our email at epondo.co@gmail.com. <br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
