@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ 'Detail' }} {{ $salesOrder->id_salesOrder }}
                                </h4>
                                <a class="btn btn-danger btn-round ml-auto addRow" target="__blank"
                                    href="/dashboard/salesorders/{{ $salesOrder->id_salesOrder }}/exportPDF">
                                    <span><i class="fa fa-file"> </i></span> Export PDF
                                </a>
                            </div>
                        </div>
                        {{-- ini bagian header --}}
                        <div class="table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        {{-- <th>Create Date</th>
                                        <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>Create Date</b> : <a>{{ $salesOrder->tanggal }}</a>
                                        </td>
                                        @if ($salesOrder->bin_id === 1)
                                            <td>
                                                <b>Sales Type</b> : <a>Beli Putus</a>
                                            </td>
                                        @else
                                            <td>
                                                <b>Sales Type</b> : <a>Konsinyasi</a>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td style="width: 50%">
                                            <a class="b">Customer</a> : <a>{{ $salesOrder->customer->nama }}</a>
                                        </td>
                                        <td>
                                            <a class="b">Stock On</a> : <a>{{ $salesOrder->bin->customer->nama }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>{{ $salesOrder->customer->alamat }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $salesOrder->bin->customer->alamat }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="b">Sales Person</a> : <a>{{ $salesOrder->employee->nama }}</a>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="parts_table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="width: 20%">Part</th>
                                            <th style="width: 30%">Part Desc</th>
                                            <th>UOM</th>
                                            <th>Lot</th>
                                            <th>Exp Date</th>
                                            <th>Unit Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @foreach ($salesOrder->salesOrderItem as $i)
                                        <tbody>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $i->inventory->part->kd_parts }}</td>
                                            <td>{{ $i->inventory->part->nama }}</td>
                                            <td>{{ $i->inventory->part->uom->nama }}</td>
                                            <td>{{ $i->inventory->lot->kd_lots }}</td>
                                            <td>{{ $i->inventory->lot->exp }}</td>
                                            <td>{{ number_format($i->hargasat, 2, '.', ',') }}</td>
                                            <td>{{ $i->qty }}</td>
                                            <td>{{ number_format($i->hargatot, 2, '.', ',') }}</td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-12 float-left">
                                <a class="b">Note</a>
                                <a>: {{ $salesOrder->note }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">Amount</a>
                                <br>
                                <a>{{ number_format($salesOrder->amount, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">PPN</a>
                                <br>
                                <a>{{ number_format($salesOrder->ppn, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">Grand Total</a>
                                <br>
                                <a>{{ number_format($salesOrder->gtotal, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <br>
                        <div class="card-action">
                            <a class="btn btn-danger ml-auto addRow" href="/dashboard/salesorders">
                                <span><i class="fa fa-chevron-left"> </i></span> Back
                            </a>
                            {{-- <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="/dashboard/purchaseorders" class="btn btn-danger">Cancel</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
