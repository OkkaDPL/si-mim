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
                                    <a href="/exportExcel/salesorders" class="btn btn-round btn-success">
                                        <i class="fa fa-file"></i>
                                        Excel
                                    </a>
                                    <a href="/dashboard/salesorders/create" class="btn btn-primary btn-round">
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
                                            <th>SO Number</th>
                                            <th>Date</th>
                                            <th>Customers</th>
                                            <th>Amount</th>
                                            <th>Sales Person</th>
                                            <th>Created by</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>SO Number</th>
                                            <th>Date</th>
                                            <th>Customers</th>
                                            <th>Amount</th>
                                            <th>Sales Person</th>
                                            <th>Created by</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($salesOrders as $salesOrder)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $salesOrder->id_salesOrder }}</td>
                                                <td>{{ $salesOrder->tanggal }}</td>
                                                <td>{{ $salesOrder->customer->nama }}</td>
                                                <td>{{ number_format($salesOrder->gtotal, 2, '.', ',') }}
                                                <td>{{ $salesOrder->employee->nama }}</td>
                                                <td>{{ $salesOrder->user->username }}</td>
                                                <td>{{ $salesOrder->status }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/dashboard/salesorders/{{ $salesOrder->id }}"
                                                            data-toggle="tooltip" class="btn btn-link btn-info btn-lg"
                                                            data-original-title="View Data"><span
                                                                class="fa fa-eye"></span></a>
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
