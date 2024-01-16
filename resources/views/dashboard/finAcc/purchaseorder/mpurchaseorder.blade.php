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

                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">{{ $title }}</h4>
                                <div>
                                    <a href="/exportExcel/purchaseorders" class="btn btn-round btn-success">
                                        <i class="fa fa-file"></i>
                                        Excel
                                    </a>
                                    <a href="/dashboard/purchaseorders/create" class="btn btn-primary btn-round">
                                        <i class="fa fa-plus"></i>
                                        Add Data
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>PO Number</th>
                                            <th>Date</th>
                                            <th>Exp Date</th>
                                            <th>Principals</th>
                                            <th>Amount</th>
                                            <th>Created by</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>PO Number</th>
                                            <th>Date</th>
                                            <th>Exp Date</th>
                                            <th>Principals</th>
                                            <th>Amount</th>
                                            <th>User</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($purchaseorder as $purchaseorder)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $purchaseorder->id_purchaseorder }}</td>
                                                <td>{{ $purchaseorder->tglCreate }}</td>
                                                <td>{{ $purchaseorder->tglExp }}</td>
                                                <td>{{ $purchaseorder->principal->nama }}</td>
                                                <td>{{ number_format($purchaseorder->gtotal, 2, '.', ',') }}
                                                <td>{{ $purchaseorder->user->username }}</td>
                                                <td>{{ $purchaseorder->status }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/dashboard/purchaseorders/{{ $purchaseorder->id }}"
                                                            data-toggle="tooltip" class="btn btn-link btn-info btn-lg"
                                                            data-original-title="View Data"><span
                                                                class="fa fa-eye"></span></a>
                                                        {{-- <a href="/dashboard/purchaseorders/{{ $purchaseorder->id }}/forSubmit"
                                                            data-toggle="tooltip" class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Data"><span
                                                                class="fa fa-edit"></span></a> --}}
                                                        {{-- <a href="/dashboard/purchaseorders/{{ $purchaseorder->id }}/edit"
                                                            data-toggle="tooltip" class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Data"><span
                                                                class="fa fa-edit"></span></a>
                                                        <form action="/dashboard/purchaseorders/{{ $purchaseorder->id }}"
                                                            method="POST" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-link btn-danger" data-toggle="tooltip"
                                                                data-original-title="Remove"
                                                                onclick="return confirm('Are you sure ?')"><span
                                                                    class="fa fa-times"></span></button>
                                                        </form> --}}
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
