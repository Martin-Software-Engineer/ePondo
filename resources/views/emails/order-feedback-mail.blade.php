@component('mail::message')
# Greetings from ePondo!

<br>You have successfully submitted Feedback for <br><b>Service Order No. {{$order_id}}</b>. 
Your Service Order is now Completed!<br><br>

From the entire ePondo Team we would like to extend our greatest thank you for using our platform 
and joining our community! We hope that you continue to support ePondo. All the best wishes! <br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
