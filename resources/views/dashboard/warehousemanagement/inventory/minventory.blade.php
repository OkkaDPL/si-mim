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
                                    <a href="/exportExcel/inventories" class="btn btn-round btn-success">
                                        <i class="fa fa-file-excel"></i>
                                        Excel
                                    </a>
                                    {{-- <a href="/dashboard/divisions/create" class="btn btn-primary btn-round">
                                        <i class="fa fa-plus"></i>
                                        Add Datas
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Part</th>
                                            <th>Part Desc</th>
                                            <th>Division</th>
                                            <th>Category</th>
                                            <th>UOM</th>
                                            <th>Qty</th>
                                            <th>LOT</th>
                                            <th>Exp Date</th>
                                            <th>Warehouse</th>
                                            <th>Bin</th>
                                            @if (auth()->user()->departement == 'Management' ||
                                                    auth()->user()->departement == 'IT' ||
                                                    auth()->user()->departement == 'Warehouse')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Part</th>
                                            <th>Part Desc</th>
                                            <th>Division</th>
                                            <th>Category</th>
                                            <th>UOM</th>
                                            <th>Qty</th>
                                            <th>LOT</th>
                                            <th>Exp Date</th>
                                            <th>Warehouse</th>
                                            <th>Bin</th>
                                            @if (auth()->user()->departement == 'Management' ||
                                                    auth()->user()->departement == 'IT' ||
                                                    auth()->user()->departement == 'Warehouse')
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($inventories as $inventory)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $inventory->part->kd_parts }}</td>
                                                <td>{{ $inventory->part->nama }}</td>
                                                <td>{{ $inventory->part->category->division->nick }}</td>
                                                <td>{{ $inventory->part->category->nama }}</td>
                                                <td>{{ $inventory->part->uom->nama }}</td>
                                                <td>{{ $inventory->qty }}</td>
                                                <td>{{ $inventory->lot->kd_lots }}</td>
                                                <td>{{ $inventory->lot->exp }}</td>
                                                <td>{{ $inventory->warehouse->id_warehouses }}</td>
                                                <td>{{ $inventory->bin->id_bins }}</td>
                                                @if (auth()->user()->departement == 'Management' ||
                                                        auth()->user()->departement == 'IT' ||
                                                        auth()->user()->departement == 'Warehouse')
                                                    <td>
                                                        <a href="/dashboard/inventories/{{ $inventory->id }}/adjustStock"
                                                            data-toggle="tooltip" class="btn btn-link btn-info btn-lg"
                                                            data-original-title="Adjust Stock"><span
                                                                class="fa fa-pen"></span></a>
                                                    </td>
                                                @endif
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
