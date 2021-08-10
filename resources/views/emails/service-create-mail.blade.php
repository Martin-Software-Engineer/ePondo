@component('mail::message')
# Greetings from ePondo!

<br>Congratulations for successfully creating a Service on ePondo!

<strong>Service Title : </strong> <span style="font-style:italic;"> " {{$service->title}} " </span> <br>
<strong>Control No. : </strong> {{System::GenerateFormattedId('S', $service->id)}} <br>
<strong>Created By : </strong> {{$jobseeker_name}} <br>
<strong>Duration : </strong> {{$service->duration_hours}} Hr/s {{$service->duration_minutes}} Min/s <br>
<strong>Location : </strong> {{$service->location}} <br>
<strong>Price : </strong> Php {{number_format($service->price)}} <br>


Best Regards,<br>
{{ config('app.name') }}
@endcomponent
