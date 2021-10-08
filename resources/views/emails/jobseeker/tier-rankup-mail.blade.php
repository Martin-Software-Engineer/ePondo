@component('mail::message')
# Greetings from ePondo!

Congratulations! You have reached the {{$newtiernotif}} Reward Tier.
You are now entitled to additional +{{$addon}}% per Service.

Thanks,<br>
{{ config('app.name') }}
@endcomponent