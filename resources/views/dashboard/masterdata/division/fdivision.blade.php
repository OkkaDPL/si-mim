@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/divisions" method="POST">
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
                                    <label for="nama" class="placeholder">Nama Divisi</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="nick" name="nick" type="text"
                                        class="form-control input-border-bottom @error('nick') is-invalid @enderror"
                                        required value="{{ old('nick') }}">
                                    <label for="nick" class="placeholder">Nama</label>
                                    @error('nick')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">Submit</button>
                                <a href="/dashboard/divisions" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to cancel the form?')">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
