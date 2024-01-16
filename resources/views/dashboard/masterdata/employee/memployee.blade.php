@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }} {{-- session success pada registercontroller --}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }} {{-- session success pada registercontroller --}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $title }}</h4>
                                <a href="/dashboard/employees/create" class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Data
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Name</th>
                                            <th>BOD</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Entry Date</th>
                                            <th>Departement</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Name</th>
                                            <th>BOD</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Entry Date</th>
                                            <th>Division</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->nip }}</td>
                                                <td>{{ $employee->nama }}</td>
                                                <td>{{ $employee->bod }}</td>
                                                <td>{{ $employee->tlp }}</td>
                                                <td>{{ $employee->user->email }}</td>
                                                <td>{{ $employee->tgl_msk }}</td>
                                                <td>{{ $employee->user->departement }} {{ $employee->division }}</td>
                                                <td>{{ $employee->status }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/dashboard/employees/{{ $employee->id }}/edit"
                                                            data-toggle="tooltip" class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Data"><span
                                                                class="fa fa-edit"></span></a>
                                                        <form action="/dashboard/employees/{{ $employee->id }}"
                                                            method="POST" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-link btn-danger" data-toggle="tooltip"
                                                                data-original-title="Remove"
                                                                onclick="return confirm('Are you sure ?')"><span
                                                                    class="fa fa-times"></span></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Add Row
            $('#add-row').DataTable({
                "pageLength": 5,
            });
            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#multi-filter-select').DataTable({
                "pageLength": 5,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });
        });
    </script>
@endsection
