@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">
                                    {{ $title }} {{ $adjStock->id_adjStock }}
                                </h4>
                            </div>
                        </div>
                        {{-- ini bagian header --}}
                        <div class="table">
                            <table class="table">
                                {{-- <thead>
                                    <tr>
                                        <th style="width: 35%">Warehouse</th>
                                        <th style="width: 35%">Bin</th>
                                    </tr>
                                </thead> --}}
                                <tbody>
                                    <tr>
                                        <td>
                                            <a class="b">Warehouse:</a>
                                            <a>{{ $adjStock->inventory->warehouse->nama }}</a>
                                        </td>
                                        <td>
                                            <a class="b">Bin:</a>
                                            <a>{{ $adjStock->inventory->bin->customer->nama }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="b">User:</a>
                                            <a>{{ $adjStock->user->username }}</a>
                                        </td>
                                        <td>
                                            <a class="b">Type:</a>
                                            <a>{{ $adjStock->status }}</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="parts_table">
                                    <thead>
                                        <tr>
                                            <th>Part</th>
                                            <th>Desc</th>
                                            <th>Division</th>
                                            <th>Category</th>
                                            <th>UOM</th>
                                            <th>QTY</th>
                                            <th>LOT</th>
                                            <th>Expired Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a>{{ $adjStock->inventory->part->kd_parts }}</a>
                                            </td>
                                            <td>
                                                <a>{{ $adjStock->inventory->part->nama }}</a>
                                            </td>
                                            <td>
                                                <a>{{ $adjStock->inventory->part->category->division->nick }}</a>
                                            </td>
                                            <td>
                                                <a>{{ $adjStock->inventory->part->category->nama }}</a>
                                            </td>
                                            <td>
                                                <a>{{ $adjStock->inventory->part->uom->nama }}</a>
                                            </td>
                                            <td>
                                                <a>{{ $adjStock->qty }}</a>
                                            </td>
                                            <td>
                                                <a>{{ $adjStock->inventory->lot->kd_lots }}</a>
                                            </td>
                                            <td>
                                                <a>{{ $adjStock->inventory->lot->exp }}</a>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-12 float-left">
                                    <a class="b">Note</a>

                                    <a>: {{ $adjStock->note }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <a href="/dashboard/adjuststock" class="btn btn-back"> <i><span
                                        class="fa fa-chevron-left"></span></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.iniSelect2').select2({
                width: '100%'
            });
        });
        var elRealQty = $('#realQty');
        var elQty = $('#qty');
        var elType = $('#type');
        elQty.on('input', function() {
            var valElRQty = elRealQty.val();
            var thisVal = $(this).val();
            var valElType = $('#type').val();
            var forOut = valElRQty - thisVal;

            if (valElType === 'Adjust Out') {
                if (forOut <= 0) {
                    this.setCustomValidity("Out of stock!");
                    console.log('Stock Tidak Tersedia');
                } else {
                    this.setCustomValidity("");
                    $(this).prop('required', true);
                }
            } else {
                this.setCustomValidity("");
                $(this).prop('required', true);
            }

        });

        elType.on('change', function() {
            elQty.val('');
            elQty.prop('required', true);

        });
    </script>
@endsection
