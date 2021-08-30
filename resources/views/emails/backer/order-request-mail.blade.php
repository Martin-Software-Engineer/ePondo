@component('mail::message')
# Greetings from ePondo!

<br>You have successfully created a Service Order Request with <br>Service Order No. <b> {{$order_id}}</b>.<br>
<hr><br>
<h3>Service Order Details</h3>
Service Title : <span style="font-style:italic;text-decoration:underline;"> " {{$order_title}} " </span> <br>
Order No. : <span style="text-decoration:underline;"> {{$order_id}} </span><br>
Price : <span style="text-decoration:underline;"> Php {{$price}} </span><br>
Jobseeker : <span style="text-decoration:underline;"> {{$jobseeker_name}} </span><br>
Service Order Date : <span style="text-decoration:underline;"> {{$render_date}} </span><br>
Delivery Address : <span style="text-decoration:underline;"> {{$delivery_address}} </span><br>
Additional Message : <span style="text-decoration:underline;"> {{$message}} </span><br><br>

Please allow 1-3 days for Jobseeker's response regarding your request.
You will be notified immediately so don't forget to check your
account for the update. Thank you!<br><br>

If you need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent