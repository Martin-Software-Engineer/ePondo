@component('mail::message')
# Greetings from ePondo!

<br>Service Order has been submitted as Delivered with <br><b>Service Order No. {{$order_id}}</b>. 
You now have a pending View Invoice and Process Payment.<br><br>

To view Invoice go to your ePondo account and view Service Order. Click the "View Invoice & Pay" button. 
You will be then routed to the invoice statement. To pay, click the "Add Payment" button. Fill in the 
necessary details to process payment.<br><br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
