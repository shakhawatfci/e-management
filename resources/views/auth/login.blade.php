<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.common_header_asset')
    <link href="{{ asset('admin-assets/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/forms/switches.css') }}">
</head>
<body class="form">
    
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">EMS | LOGIN</h1>
                        <p class="">Log in to your account to continue.</p>
                        
                        <form class="text-left" method="POST" action="{{ route('login') }}">
                         @csrf
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                 @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                    <label for="username">Email</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="email" type="text"
                                     class="form-control" placeholder="Enter Email Address" value="{{ old('email') }}">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                  @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-pass-link">Forgot Password?</a>
                                     @endif
                                        
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>

                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Log In</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

   @include('include.common_footer_asset')
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('admin-assets/assets/js/authentication/form-2.js') }}"></script>

</body>
</html>
