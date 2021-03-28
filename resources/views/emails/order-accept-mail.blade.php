@component('mail::message')
# Greetings from ePondo!

You have accepted <b>Service Order No. {{$order_id}}</b>

Please refer to the order. for more details about the order.
This can be found at the <b>Service Orders tab on your dashboard</b>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
