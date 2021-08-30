@component('mail::message')
<br>
<h1 style="text-align:center;">CONGRATULATIONS</h1><br>

You have successfully Completed Service Order {{$order_id}}.<br>

From the entire ePondo Team we would like to extend our greatest thank you for using our platform 
and joining our community! Your participation to this research and initiative is greatly 
appreciated. We are glad that we were able to serve you. And to better serve you in the future 
you may reach out to us through epondo.co@gmail.com. We hope that you continue to support ePondo. All the best wishes! <br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
