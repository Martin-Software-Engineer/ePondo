@component('mail::message')
# Greetings from ePondo!

<br>Payment Successful for <b>Service Order No. {{$order_id}}</b><br><br>

<hr><br>
<h3>Payment Details</h3>
<!-- Service Title : <span style="font-style:italic;text-decoration:underline;"> " {{$order_title}} " </span> <br> -->
Order No. : <span style="text-decoration:underline;"> {{$order_id}} </span><br>
Price : <span style="text-decoration:underline;"> Php {{$price}} </span><br>
Jobseeker : <span style="text-decoration:underline;"> {{$jobseeker_name}} </span><br>
Service Order Date : <span style="text-decoration:underline;"> {{$render_date}} </span><br>
Delivery Address : <span style="text-decoration:underline;"> {{$delivery_address}} </span><br>

We are also reminding you that you have a <strong>Pending Feedback</strong> of the 
service order to accomplish.<br><br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
