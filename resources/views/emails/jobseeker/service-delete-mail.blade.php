@component('mail::message')
# Greetings from ePondo!

Service Deleted<br>

We are saddened to hear that you have deleted your service.
Feel free to contact us to discuss any issues and problems encountered 
that lead you to the deletion of the service. 
You may contact us through our email at epondo.co@gmail.com. <br><br>

<strong>Service Title : </strong> <span style="font-style:italic;"> " {{$service->title}} " </span> <br>
<strong>Created By : </strong> {{$jobseeker_name}} <br>
<strong>Duration : </strong> {{$service->duration_hours}} Hr/s {{$service->duration_minutes}} Min/s <br>
<strong>Location : </strong> {{$service->location}} <br>
<strong>Price : </strong> Php {{number_format($service->price)}} <br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
