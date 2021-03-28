@component('mail::message')
# Greetings from ePondo!

You have a new Service Order Request from {{$backer_name}}, <b>Service Order No. {{$rder_id}}</b>
Click on <b>Service Orders</b> on your dashboard to view the request.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
