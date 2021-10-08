@component('mail::message')
# Greetings from ePondo!

<br>Payment Successful for <b>Service Order No. {{$order_id}}</b><br><br>

<hr><br>
<h3>Payment Details</h3>

Invoice No. : <span style="text-decoration:underline;"> {{$invoice_id}} </span><br>
Status : <span style="text-decoration:underline;"> PAID </span><br>
Date Paid : <span style="text-decoration:underline;"> {{$paid_at}} </span><br>
Total Amount Paid : <span style="text-decoration:underline;"> Php {{$amount}} </span><br>
Backer/Customer (Payers Name) : <span style="text-decoration:underline;"> {{$backer_name}} </span><br><br>

Service Order No. : <span style="text-decoration:underline;"> {{$order_id}} </span><br>
Service Order Date : <span style="text-decoration:underline;"> {{$render_date}} </span><br>
Service Title : <span style="font-style:italic;text-decoration:underline;"> " {{$service_title}} " </span> <br>
Delivery Address : <span style="text-decoration:underline;"> {{$delivery_address}} </span><br>
Payment Method : <span style="text-decoration:underline;"> {{$payment_method}} </span><br>
Jobseeker : <span style="text-decoration:underline;"> {{$jobseeker_name}} </span><br><br>

We are also reminding you that you have a <strong>Pending Feedback</strong> of the 
service order to accomplish.<br><br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
