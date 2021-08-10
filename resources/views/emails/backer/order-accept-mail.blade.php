@component('mail::message')
# Greetings from ePondo!

<br>Your Service Order Request with No.<b>{{$order_id}}</b> has been Accepted!<br><br>

Please double check the details of the service order. And you are also highly encouraged 
to contact your jobseeker to confirm all the details of the service order.
Remember that after service order has been delivered and jobseeker has confirmed this 
on his account, you will receive an Invoice and Payment option. Please process the payment 
before the due date. Thank you!<br><br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
