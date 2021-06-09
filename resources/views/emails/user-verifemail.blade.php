@component('mail::message')
# Greetings from ePondo!

Thanks for getting started with ePondo! We need a little more information to complete
your registration, including the confirmation of your email address. Please click the 
button below to verify your email address. <br>

If you did not create an account, please contact us at epondo@gmail.com

<form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div class="action">
                        <button type="submit" class="button-primary">Verify Email</button>
                    </div>
                    <!-- <div class="donate_btn_main">
                        <div class="donate_btn_1"><a href="#">Donate Now</a></div>
                    </div> -->
                </form>

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
