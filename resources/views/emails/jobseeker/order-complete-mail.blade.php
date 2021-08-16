@component('mail::message')
# Greetings from ePondo!

<h1 style="text-align:center;">CONGRATULATIONS</h1><br>
You have successfully Completed Service Order {{$order_id}}.<br>

From the entire ePondo Team we would like to extend our greatest thank you for using our platform 
and joining our community! We hope that you continue to support ePondo. All the best wishes! <br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
