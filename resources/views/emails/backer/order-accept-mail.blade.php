@component('mail::message')
# Greetings from ePondo!

<br>Your Service Order Request with No. <b>{{$order_id}}</b> has been Accepted!<br><br>

Please double check the details of the service order. And you are also highly encouraged 
to contact your jobseeker to confirm all the details of the service order.<br>

<span style="font-weight:500;">(For Payment Method : Online Payment)</span><br>
Remember that after service order has been delivered and jobseeker has confirmed this 
on his account, you will receive an Invoice and Payment option. Please process the payment 
before the due date.<br>

<span style="font-weight:500;">(For Payment Method : Cash-On-Delivery)</span><br>
Your Invoice will be issued. Please check your Invoice and prepare the cash payment before the delivery date.
This is to prevent delays and to facilitate any questions regarding the Invoice beforehand.
To view Invoice go to your ePondo account and view Service Order. Click the "View Invoice" button. 
You will then be routed to the invoice statement.<br><br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
