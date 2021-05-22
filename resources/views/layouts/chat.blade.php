@if(auth()->user()->hasAnyRole('Admin'))
    @include('admin.layouts.chat')
@elseif(auth()->user()->hasAnyRole('JobSeeker'))
    @include('jobseeker.layouts.chat')
@elseif(auth()->user()->hasAnyRole('Backer'))
    @include('backer.layouts.chat')
@endif