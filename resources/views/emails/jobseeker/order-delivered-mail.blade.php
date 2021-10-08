@component('mail::message')
# Greetings from ePondo!

<br>You have successfully Submitted Service Order Delivered<br> for Service Order No. <b>{{$order_id}}</b><br><br>

Invoice has been sent to your customer/backer. You may also view this under your "Ïnvoice" Tab. Please wait patiently 
for your customer to complete this task. Once payment has been processed you may view this under your "Earning" Tab 
and process Payout then after.<br><br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
