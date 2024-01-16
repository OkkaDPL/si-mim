@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/lots/{{ $lot->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <input id="kd_lots" name="kd_lots" type="text"
                                        class="form-control input-border-bottom @error('kd_lots') is-invalid @enderror"
                                        required value="{{ old('kd_lots', $lot->kd_lots) }}">
                                    <label for="kd_lots" class="placeholder">Lots Number</label>
                                    @error('kd_lots')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exp">Exp Date</label>
                                    <input type="date" name="exp"
                                        class="form-control @error('exp') is-invalid @enderror" required
                                        value="{{ old('exp', $lot->exp) }}" id="exp">
                                    @error('exp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit this form?')">Submit</button>
                                <a href="/dashboard/lots" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to cancel this form?')">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
