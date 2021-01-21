<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login Form</title>
        <link rel="stylesheet" href="css/style4.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>

    <body>
        <div class="container">
            <header>Login Form</header>
            <div class="form-outer">

                <!-- Added from the template status alert -->
                @if (session('status'))
                    <div class="alert alert-danger mt-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">

                @csrf
                    <div class="page">
                        <div class="title">Login Details:</div>

                        <div class="field">
                            <div class="label">Username</div>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter Email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror

                        </div>
                    
                        <div class="field">
                            <div class="label">Password</div>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>  
                        
                        <div class="pass-link"><a href="forgot-password">Forgot Password?</a></div>
                        
                        <div class="field btns">
                            <button class="Submit">Submit</button>
                        </div> 
                    
                        <div class="signup-link">Not a member? <a href="register">Register now</a></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>