@component('mail::message')
# Greetings from ePondo!

<br>Payment Unsuccessful for <b>Service Order No. {{$order_id}}</b>
please try again.<br><br>

If you need assistance you may contact us at epondo.co@gmail.com. Thank you!<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
