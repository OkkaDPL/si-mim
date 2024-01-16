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
                                    <a href="/exportExcel/goodreceipts" class="btn btn-success btn-round">
                                        <i class="fa fa-file"></i>
                                        Excel
                                    </a>
                                    <a href="/dashboard/goodreceipts/create" class="btn btn-primary btn-round ml-auto">
                                        <i class="fa fa-plus"></i>
                                        Add Data
                                    </a>
                                    <!-- Tambahkan elemen <a> lain di sini -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>GR Number</th>
                                            <th>Date</th>
                                            <th>PO Number</th>
                                            <th>Principals</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>GR Number</th>
                                            <th>Date</th>
                                            <th>PO Number</th>
                                            <th>Principals</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($goodreceipts as $goodreceipt)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $goodreceipt->id_goodreceipt }}</td>
                                                <td>{{ $goodreceipt->tanggal }}</td>
                                                <td>{{ $goodreceipt->purchaseOrder->id_purchaseorder }}</td>
                                                <td>{{ $goodreceipt->purchaseOrder->principal->nama }}
                                                </td>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/dashboard/goodreceipts/{{ $goodreceipt->id }}"
                                                            data-toggle="tooltip" class="btn btn-link btn-info btn-lg"
                                                            data-original-title="View Data"><span
                                                                class="fa fa-eye"></span></a>
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
