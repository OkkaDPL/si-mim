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
                                <a href="/exportExcel/inventoryMovement" class="btn btn-success btn-round ml-auto">
                                    <i class="fa fa-file"></i>
                                    Excel
                                </a>
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
                                            <th>Transaction</th>
                                            <th>Doc Number</th>
                                            <th>Transaction Date</th>
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
                                            <th>Transaction</th>
                                            <th>Doc Number</th>
                                            <th>Transaction Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($inventorymovement as $imovement)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $imovement->inventory->part->kd_parts }}</td>
                                                <td>{{ $imovement->inventory->part->nama }}</td>
                                                <td>{{ $imovement->inventory->part->category->division->nick }}</td>
                                                <td>{{ $imovement->inventory->part->category->nama }}</td>
                                                <td>{{ $imovement->inventory->part->uom->nama }}</td>
                                                <td>{{ $imovement->qty }}</td>
                                                <td>{{ $imovement->inventory->lot->kd_lots }}</td>
                                                <td>{{ $imovement->inventory->lot->exp }}</td>
                                                <td>{{ $imovement->inventory->warehouse->nama }}</td>
                                                <td>{{ $imovement->inventory->bin->id_bins }}</td>
                                                <td>{{ $imovement->from }}</td>
                                                <td>{{ $imovement->doc }}</td>
                                                <td>{{ $imovement->created_at->format('d-m-Y') }}</td>
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
