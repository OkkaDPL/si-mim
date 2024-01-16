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
                            {{-- <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $title }}</h4>
                                <a href="/dashboard/divisions/create" class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Datas
                                </a>
                            </div> --}}
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">{{ $title }}</h4>
                                <div>
                                    <a href="/exportExcel/adjuststock" class="btn btn-round btn-success">
                                        <i class="fa fa-file-excel"></i>
                                        Excel
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
                                            <th>Adj Number</th>
                                            <th>Part</th>
                                            <th>Part Desc</th>
                                            <th>UOM</th>
                                            <th>Qty</th>
                                            <th>LOT</th>
                                            <th>Exp Date</th>
                                            <th>Warehouse</th>
                                            <th>Bin</th>
                                            <th>Type</th>
                                            <th>User</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Adj Number</th>
                                            <th>Part</th>
                                            <th>Part Desc</th>
                                            <th>UOM</th>
                                            <th>Qty</th>
                                            <th>LOT</th>
                                            <th>Exp Date</th>
                                            <th>Warehouse</th>
                                            <th>Bin</th>
                                            <th>Type</th>
                                            <th>User</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($adjStock as $i)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $i->id_adjStock }}</td>
                                                <td>{{ $i->inventory->part->kd_parts }}</td>
                                                <td>{{ $i->inventory->part->nama }}</td>
                                                <td>{{ $i->inventory->part->uom->nama }}</td>
                                                <td>{{ $i->qty }}</td>
                                                <td>{{ $i->inventory->lot->kd_lots }}</td>
                                                <td>{{ $i->inventory->lot->exp }}</td>
                                                <td>{{ $i->inventory->warehouse->nama }}</td>
                                                <td>{{ $i->inventory->bin->customer->nama }}</td>
                                                <td>{{ $i->status }}</td>
                                                <td>{{ $i->user->username }}</td>
                                                <td>
                                                    <a href="/dashboard/adjuststock/{{ $i->id }}"
                                                        data-toggle="tooltip" class="btn btn-link btn-info btn-lg"
                                                        data-original-title="Show Detail"><span
                                                            class="fa fa-eye"></span></a>
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
