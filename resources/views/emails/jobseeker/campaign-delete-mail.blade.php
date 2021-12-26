@component('mail::message')
# Greetings from ePondo!

Campaign Deleted<br>

We are saddened to hear that you have deleted your campaign.
Feel free to contact us to discuss any issues and problems encountered 
that lead you to the deletion of the campaign. 
You may contact us through our email at epondo.co@gmail.com. <br><br>

<strong>Campaign Title : </strong> <span style="font-style:italic;"> " {{$campaign->title}} " </span> <br>
<strong>Created By : </strong> {{$jobseeker_name}} <br>
<strong>Target Date : </strong> {{date('F d, Y', strtotime($campaign->target_date))}} <br>
<strong>Target Amount : </strong> Php {{number_format($campaign->target_amount)}} <br>


Best Regards,<br>
{{ config('app.name') }}
@endcomponent
