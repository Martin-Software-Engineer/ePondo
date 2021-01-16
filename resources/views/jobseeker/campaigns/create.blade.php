@extends('layouts.app')

@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Create Campaign</h1>
            <div class="card">

                <form method="POST" action="{{ route('jobseeker.campaigns.store') }}" enctype="multipart/form-data">
                    @include('jobseeker.campaigns.partials.form')

                    <!-- <input type="file" name="image" id="image[]" class="" multiple> -->

                    <!-- <input type="file" name="file" id="profile-img">
                    <img src="" id="profile-img-tag" width="200px" />

                        <script type="text/javascript">
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    
                                    reader.onload = function (e) {
                                        $('#profile-img-tag').attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            $("#profile-img").change(function(){
                                readURL(this);
                            });
                        </script> -->

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
