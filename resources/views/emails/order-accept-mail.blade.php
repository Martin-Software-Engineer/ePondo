@component('mail::message')
# Greetings from ePondo!

<br>You have successfully Accepted <b>Service Order No. {{$order_id}}</b><br><br>

Please double check the details of the service order. And you are also highly encouraged 
to contact your customer/backer to confirm all the details of the service order.
Remember that after service order has been delivered, you must submit service order delivered 
in your account through the Service Orders tab. <br><br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
