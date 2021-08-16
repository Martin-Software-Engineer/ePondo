@component('mail::message')
# Greetings from ePondo!

<br>Congratulations, you have Successfully Donated to Campaign!<br>
<hr><br>
<h3>Campaign Donation Details</h3>
Campaign Title : <span style="font-style:italic;text-decoration:underline;"> " XXX " </span> <br>
Jobseeker : <span style="text-decoration:underline;"> XXX </span><br>
Donated Amount : <span style="text-decoration:underline;"> Php XXX </span><br>
Total Amount : <span style="text-decoration:underline;"> Php XXX </span><br>
Date : <span style="text-decoration:underline;"> XXX </span><br>

From the entire ePondo Team we would like to extend our greatest thank you for using our platform 
and generously donating to your preferred campaign! We hope that you continue to support ePondo. 
All the best wishes! <br><br>

If you have any questions or need assistance you may contact us at epondo.co@gmail.com.<br><br>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
