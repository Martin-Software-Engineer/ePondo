@component('mail::message')
# Greetings from ePondo!

Congratulations! You have reached the {{$tier->title}} You are only a few steps away from reaching the {{$nextTier->title}}.

Tips on how to increase you points? Complete more service ordersto earn more points!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
