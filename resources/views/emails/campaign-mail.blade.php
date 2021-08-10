@component('mail::message')
# Greetings from ePondo!

Congratulations for successfully creating a Campaign on ePondo!

<strong>Campaign Title : </strong> <span style="font-style:italic;"> " {{$campaign->title}} " </span> <br>
<strong>Control No. : </strong> {{$campaign->id}} <br>
<strong>Created By : </strong> {{$jobseeker_name}} <br>
<strong>Target Date : </strong> {{date('F d, Y', strtotime($campaign->target_date))}} <br>
<strong>Target Amount : </strong> Php {{number_format($campaign->target_amount)}} <br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
