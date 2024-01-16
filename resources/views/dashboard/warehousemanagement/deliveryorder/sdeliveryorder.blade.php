@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ 'Detail' }} {{ $deliveryOrder->id_deliveryOrder }}</h4>
                                <a class="btn btn-danger btn-round ml-auto addRow" target="__blank"
                                    href="/dashboard/deliveryorders/{{ $deliveryOrder->id_deliveryOrder }}/exportPDF">
                                    <span><i class="fa fa-file"> </i></span> Export PDF
                                </a>
                            </div>
                        </div>
                        {{-- ini bagian header --}}
                        <div class="table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Create Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a>{{ $deliveryOrder->tanggal }}</a>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="b">From</a> :
                                            <a>{{ $deliveryOrder->salesOrder->warehouse->namaPt }}</a>
                                        </td>
                                        <td>
                                            <a class="b">Ship to</a> :
                                            <a>{{ $deliveryOrder->salesOrder->customer->nama }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>{{ $deliveryOrder->salesOrder->warehouse->alamat }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $deliveryOrder->salesOrder->customer->alamat }}</a>
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
                                            <th>No</th>
                                            <th style="width: 20%">Part</th>
                                            <th style="width: 30%">Part Desc</th>
                                            <th>UOM</th>
                                            <th>Qty</th>
                                            <th>Lot</th>
                                            <th>Exp Date</th>
                                        </tr>
                                    </thead>
                                    @foreach ($deliveryOrder->deliveryOrderItem as $i)
                                        <tbody>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $i->salesOrderItem->inventory->part->kd_parts }}</td>
                                            <td>{{ $i->salesOrderItem->inventory->part->nama }}</td>
                                            <td>{{ $i->salesOrderItem->inventory->part->uom->nama }}</td>
                                            <td>{{ $i->salesOrderItem->qty }}</td>
                                            <td>{{ $i->salesOrderItem->inventory->lot->kd_lots }}</td>
                                            <td>{{ $i->salesOrderItem->inventory->lot->exp }}</td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-left">
                                <a class="b">Note</a>
                                <a>: {{ $deliveryOrder->note }}</a>
                            </div>
                        </div>
                        <div class="card-action">
                            {{-- <button class="btn btn-primary" type="submit">Submit</button> --}}
                            <a class="btn btn-back ml-auto addRow" href="/dashboard/deliveryorders">
                                <span><i class="fa fa-chevron-left"> </i></span> Back
                            </a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
