@component('mail::message')
# Greetings from ePondo!

Campaign - Edited Successfully!

<strong>Campaign Title : </strong> <span style="font-style:italic;"> " {{$campaign->title}} " </span> <br>
<strong>Created By : </strong> {{$jobseeker_name}} <br>
<strong>Target Date : </strong> {{date('F d, Y', strtotime($campaign->target_date))}} <br>
<strong>Target Amount : </strong> Php {{number_format($campaign->target_amount)}} <br>

Please be reminded to check your account for updates regarding the progress
of your campaigns. If you have any questions or need assistance you may contact 
us at epondo.co@gmail.com. Thank you!<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
