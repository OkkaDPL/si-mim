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
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">{{ $title }}</h4>
                                    <button class="btn btn-primary btn-round ml-auto addRow">
                                        <span><i class="fa fa-plus"></i></span> Add Row
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="divisions_table">
                                        <thead>
                                            <tr>
                                                <th>Divisi</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (old('nama', ['']) as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input id="nama" name="nama[]" type="text"
                                                            class="form-control input-border-bottom @error('nama.' . $key) is-invalid @enderror"
                                                            required value="{{ old('nama.' . $key) }}">
                                                        @error('nama.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="nick" name="nick[]" type="text"
                                                            class="form-control input-border-bottom @error('nick.' . $key) is-invalid @enderror"
                                                            required value="{{ old('nick.' . $key) }}">
                                                        @error('nick.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        {{-- <button type="button" class="btn btn-danger removeRow"><span><i
                                                                    class="flaticon-interface-5"></i></span></button> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <a href="/dashboard/divisions" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Add new row to the table
            $(".addRow").click(function() {
                var html = '<tr>' +
                    '<td><input id="nama" name="nama[]" type="text" class="form-control input-border-bottom" required></td>' +
                    '<td><input id="nick" name="nick[]" type="text" class="form-control input-border-bottom" required></td>' +
                    '<td><button type="button" class="btn btn-danger removeRow"><span><i class="flaticon-interface-5"></i></span></button></td>' +
                    '</tr>';
                $("#divisions_table tbody").append(html);
            });
            // Remove row from table
            $("#divisions_table").on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
