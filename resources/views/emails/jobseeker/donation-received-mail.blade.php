@component('mail::message')
# Greetings from ePondo!

<br><h1 style="text-align:center;">CONGRATULATIONS</h1><br>
You have received a donation for your campaign! <br>

<hr><br>
<h3>Campaign Donation Details</h3>
Campaign Title : <span style="font-style:italic;text-decoration:underline;"> " {{$title}} " </span> <br>
Jobseeker : <span style="text-decoration:underline;"> {{$jobseeker}} </span><br>
Amount : <span style="text-decoration:underline;"> Php {{$amount}} </span><br>
Date : <span style="text-decoration:underline;"> {{$date}} </span><br>
Donated By : <span style="text-decoration:underline;"> {{$donated_by}} </span><br>

Check your account for more details. To check the 
status of your campaign go to your "My Campaigns" tab. 
To payout your earnings go to your "Earnings" tab.<br>

If you have any question or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
