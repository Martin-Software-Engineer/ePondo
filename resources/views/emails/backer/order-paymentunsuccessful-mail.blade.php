@component('mail::message')
# Greetings from ePondo!

<br>
Payment Unsuccessful for Service Order No. : <b>{{$order_id}}</b>.
Please retry payment. If you are having trouble with the processing of 
payment, you may reach out to us for assistance at epondo.co@gmail.com<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
