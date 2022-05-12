<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.verification_css')
</head>
<body>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <p class="auth-subtitle">Input your data to register to our website.</p>
                <div class="text-center align-items-center">
                    @if (session('message'))
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif
                </div>
                <form action="{{route('register.user')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-xl  @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-xl" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Sign Up</button>
                </form>
                <div class="text-center mt-4 text-lg fs-6">
                    <p class='text-gray-600'>Already have an account?
                        <a href="{{route('login')}}" class="font-bold">Log in</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right"></div>
        </div>
    </div>
</div>
</body>
</html>
