@extends('login-dan-register.index')
@section('container')
    <div class="login-form">
        <form action="/login" method="POST">
            @csrf
            <div class="form-group form-floating-label">
                <input id="email" name="email" type="email"
                    class="form-control input-border-bottom @error('email') is-invalid @enderror" required
                    value="{{ old('email') }}"autofocus>
                <label for="email" class="placeholder">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group form-floating-label">
                <input id="password" name="password" type="password"
                    class="form-control input-border-bottom @error('password') is-invalid @enderror" required>
                <label for="password" class="placeholder">Password</label>
                <div class="show-password">
                    <i class="flaticon-interface"></i>
                </div>
            </div>
            <div class="row form-sub m-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberme">
                    <label class="custom-control-label" for="rememberme">Remember Me</label>
                </div>

                {{-- <a href="#" class="link float-right">Forget Password ?</a> --}}
            </div>
            <div class="form-action mb-3">
                <button class="btn btn-primary btn-rounded btn-login" type="submit">Login</button>
            </div>
            {{-- <div class="login-account">
                <span class="msg">Not registered?</span>
                <a href="/register" id="show-signup" class="link">Register now!</a>
            </div> --}}
        </form>
    </div>
@endsection
