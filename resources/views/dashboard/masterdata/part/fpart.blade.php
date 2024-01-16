@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/parts" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <input id="kd_parts" name="kd_parts" type="text"
                                        class="form-control input-border-bottom @error('kd_parts') is-invalid @enderror"
                                        required value="{{ old('kd_parts') }}">
                                    <label for="kd_parts" class="placeholder">Parts Number</label>
                                    @error('kd_parts')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="nama" name="nama" type="text"
                                        class="form-control input-border-bottom @error('nama') is-invalid @enderror"
                                        required value="{{ old('nama') }}">
                                    <label for="nama" class="placeholder">Part Description</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <a>UOM</a>
                                    <select class="iniSelect form-control @error('uom_id') is-invalid @enderror"
                                        for="uom_id" id="uom_id" name="uom_id" required>
                                        <option value="">Select UOM</option selected>
                                        @foreach ($uoms as $uom)
                                            @if (old('uom_id') == $uom->id)
                                                <option value="{{ $uom->id }}" selected>{{ $uom->nama }}</option>
                                            @else
                                                <option value="{{ $uom->id }}">{{ $uom->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('uom_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <a>Category</a>
                                    <select class="iniSelect form-control @error('category_id') is-invalid @enderror"
                                        for="category_id" id="category_id" name="category_id" required>
                                        <option value="" selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            @if (old('category_id') == $category->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->nama }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit this form?')">Submit</button>
                                <a href="/dashboard/parts" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to cancel this form?')">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.iniSelect').select2();
        });
    </script>
@endsection
