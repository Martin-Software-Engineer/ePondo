@component('mail::message')
# Greetings from ePondo!

Service - Edited Successfully!

<strong>Service Title : </strong> <span style="font-style:italic;"> " {{$service->title}} " </span> <br>
<strong>Created By : </strong> {{$jobseeker_name}} <br>
<strong>Duration : </strong> {{$service->duration_hours}} Hr/s {{$service->duration_minutes}} Min/s <br>
<strong>Location : </strong> {{$service->location}} <br>
<strong>Price : </strong> Php {{number_format($service->price)}} <br>

Please be reminded to check your account for updates. If you have any questions or need assistance 
you may contact us at epondo.co@gmail.com. Thank you!<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
