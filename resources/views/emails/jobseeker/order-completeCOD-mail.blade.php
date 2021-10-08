@component('mail::message')
# Greetings from ePondo!

<br>You have successfully Submitted Service Order Delivered & Payment Received<br> for Service Order No. <b>{{$order_id}}</b><br><br>

<h3>Payment Details</h3>

Service Title : <span style="font-style:italic;text-decoration:underline;"> " {{$service_title}} " </span> <br>
Order No. : <span style="text-decoration:underline;"> {{$order_id}} </span><br>
Invoice No. : <span style="text-decoration:underline;"> {{$invoice_id}} </span><br>
Payment Status : <span style="text-decoration:underline;"> PAID </span><br>
Price : <span style="text-decoration:underline;"> Php {{$price}} </span><br>
Service Order Date : <span style="text-decoration:underline;"> {{$render_date}} </span><br>
Delivery Address : <span style="text-decoration:underline;"> {{$delivery_address}} </span><br>
Payment Method : <span style="text-decoration:underline;"> {{$payment_method}} </span><br>
Backer/Customer : <span style="text-decoration:underline;"> {{$backer_name}} </span><br><br>

We are also reminding you that you have a <strong>Pending Feedback & Rating</strong> of the 
service order to accomplish.<br><br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
