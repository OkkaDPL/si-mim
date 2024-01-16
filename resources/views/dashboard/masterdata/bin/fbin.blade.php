@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/bins" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <a>Customer</a>
                                    <select class="iniSelect form-control @error('customer_id') is-invalid @enderror"
                                        for="customer_id" id="customer_id" name="customer_id" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            @if (old('customer_id') == $customer->id)
                                                <option value="{{ $customer->id }}" selected>{{ $customer->nama }}</option>
                                            @else
                                                <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('customer_id')
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
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">Submit</button>
                                <a href="/dashboard/warehouses"
                                    class="btn btn-danger"onclick="return confirm('Are you sure to cancel the form?')">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#customer_id').select2();
        });
    </script>
@endsection
