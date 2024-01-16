@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/warehouses" method="POST">
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
                                    <label for="nama" class="placeholder">Warehouse Name</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="namaPt" name="namaPt" type="text"
                                        class="form-control input-border-bottom @error('namaPt') is-invalid @enderror"
                                        required value="{{ old('namaPt') }}">
                                    <label for="namaPt" class="placeholder">PT Name</label>
                                    @error('namaPt')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
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
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <a href="/dashboard/warehouses" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
