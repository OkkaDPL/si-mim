@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/categories/{{ $categories->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <input id="nama" name="nama" type="text"
                                        class="form-control input-border-bottom @error('nama') is-invalid @enderror"
                                        required value="{{ old('nama', $categories->nama) }}">
                                    <label for="nama" class="placeholder">Category</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <select class="form-control" for="division_id" id="division_id" name="division_id"
                                        required>
                                        @foreach ($divisions as $division)
                                            @if (old('division_id', $categories->division_id) == $division->id)
                                                <option value="{{ $division->id }}" selected>{{ $division->nick }}</option>
                                            @else
                                                <option value="{{ $division->id }}">{{ $division->nick }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">Division</label>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">Submit</button>
                                <a href="/dashboard/categories" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to cancel the form?')">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
