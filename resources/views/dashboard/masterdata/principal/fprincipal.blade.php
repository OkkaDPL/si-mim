@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/principals" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <input id="nama" name="nama" type="text"
                                        class="form-control input-border-bottom @error('nama') is-invalid @enderror"
                                        required value="{{ old('nama') }}">
                                    <label for="nama" class="placeholder">Name</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="tlp" name="tlp" type="text" pattern="[0-9]{7,13}"
                                        class="form-control input-border-bottom @error('tlp') is-invalid @enderror" required
                                        value="{{ old('tlp') }}">
                                    <label for="tlp" class="placeholder">Phone number</label>
                                    @error('tlp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="email" name="email" type="email"
                                        class="form-control input-border-bottom @error('email') is-invalid @enderror"
                                        required value="{{ old('email') }}">
                                    <label for="email" class="placeholder">E-mail</label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="comment">Address</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" required id="alamat" name="alamat"
                                            type="text" rows="5">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="drek" name="drek" type="text"
                                        class="form-control input-border-bottom @error('drek') is-invalid @enderror"
                                        required value="{{ old('drek') }}">
                                    <label for="drek" class="placeholder">Bank Name</label>
                                    @error('drek')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="norek" name="norek" type="text" pattern="[0-9]{10,15}"
                                        class="form-control input-border-bottom @error('norek') is-invalid @enderror"
                                        required value="{{ old('norek') }}">
                                    <label for="norek" class="placeholder">Account</label>
                                    @error('norek')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit this form?')">Submit</button>
                                <a href="/dashboard/principals" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to cancel this form?')">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
