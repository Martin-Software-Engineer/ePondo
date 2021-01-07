@component('mail::message')
# Greetings from ePondo!

Thanks for getting started with ePondo! We need a little more information to complete
your registration, including the confirmation of your email address. Please click the 
button below to verify your email address. <br>

If you did not create an account, please contact us at epondo@gmail.com

<form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-1">Verify Email</button>
                </form>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
