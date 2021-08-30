@component('mail::message')
# Greetings from ePondo!

<br>You have successfully submitted Feedback for <br>Service Order No. : <b>{{$order_id}}</b> . 
Thank you for providing us with your honest feedback regarding your experience with the platform. 
The ePondo Team will review this information to better serve you in the future!<br><br>

Your Service Order is now Completed!<br><br>

From the entire ePondo Team we would like to extend our greatest thank you for using our platform 
and joining our community! We hope that you continue to support ePondo. All the best wishes! <br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
