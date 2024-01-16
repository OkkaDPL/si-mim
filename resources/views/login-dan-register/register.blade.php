@extends('login-dan-register.index')
@section('container')
    <div class="register-form">
        <form action="/register" method="POST">
            @csrf
            {{-- <div class="form-group form-floating-label">
            <input  id="name" name="name" type="text" class="form-control input-border-bottom @error('name') is-invalid @enderror" required value="{{ old('name') }}">
            <label for="name" class="placeholder">Name</label>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}
            <div class="form-group form-floating-label">
                <input id="username" name="username" type="text"
                    class="form-control input-border-bottom @error('username') is-invalid @enderror" required
                    value="{{ old('username') }}">
                <label for="username" class="placeholder">Username</label>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group form-floating-label">
                <input id="email" name="email" type="email"
                    class="form-control input-border-bottom @error('email') is-invalid @enderror" required
                    value="{{ old('email') }}">
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
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row form-sub m-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="agree" id="agree">
                    <label class="custom-control-label" for="agree">I Agree the terms and conditions.</label>
                </div>
            </div>
            <div class="form-action">
                <a href="/login" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
                <button class="btn btn-primary btn-rounded btn-login" type="submit">Register</button>
                {{-- <a href="#" class="btn btn-primary btn-rounded btn-login" type="submit">Register</a> --}}
            </div>
        </form>
        <small class="d-block text-center mt-3">Already registered? Click the cancel button!</small>
    </div>
@endsection
