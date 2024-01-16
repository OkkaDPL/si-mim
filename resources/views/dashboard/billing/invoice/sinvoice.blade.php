@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">{{ 'Detail' }} {{ $invoice->id_invoice }}</h4>
                                <div>
                                    <a class="btn btn-danger btn-round ml-auto addRow" target="__blank"
                                        href="/dashboard/invoice/kwitansi/{{ $invoice->id_invoice }}/exportPDF">
                                        <span><i class="fa fa-file"> </i></span> Kwitansi
                                    </a>
                                    <a class="btn btn-danger btn-round ml-auto addRow" target="__blank"
                                        href="/dashboard/invoice/{{ $invoice->id_invoice }}/exportPDF">
                                        <span><i class="fa fa-file"> </i></span> Export PDF
                                    </a>
                                </div>
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
                                        <td style="width: 50%">
                                            <a>{{ $invoice->deliveryOrder->tanggal }}</a>
                                        </td>
                                        <td>
                                            {{-- <a>{{ $purchaseOrder->tglExp }}</a> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="b">From</a> :
                                            <a>{{ $invoice->deliveryOrder->salesOrder->warehouse->namaPt }}</a>
                                        </td>
                                        <td>
                                            <a class="b">Bill to</a> :
                                            <a>{{ $invoice->deliveryOrder->salesOrder->customer->nama }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>{{ $invoice->deliveryOrder->salesOrder->warehouse->alamat }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $invoice->deliveryOrder->salesOrder->customer->alamat }}</a>
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
                                            <th>Unit Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @foreach ($invoice->invoiceItem as $i)
                                        <tbody>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $i->deliveryOrderItem->salesOrderItem->inventory->part->kd_parts }}</td>
                                            <td>{{ $i->deliveryOrderItem->salesOrderItem->inventory->part->nama }}</td>
                                            <td>{{ $i->deliveryOrderItem->salesOrderItem->inventory->part->uom->nama }}
                                            </td>
                                            <td>{{ number_format($i->deliveryOrderItem->salesOrderItem->hargasat, 2, '.', ',') }}
                                            </td>
                                            <td>{{ $i->deliveryOrderItem->salesOrderItem->qty }}</td>
                                            <td>{{ number_format($i->deliveryOrderItem->salesOrderItem->hargatot, 2, '.', ',') }}
                                            </td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-12 float-left">
                                <a class="b">Note</a>

                                <a>: {{ $invoice->deliveryOrder->note }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">Amount</a>
                                <br>
                                <a>{{ number_format($invoice->deliveryOrder->salesOrder->amount, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">PPN</a>
                                <br>
                                <a>{{ number_format($invoice->deliveryOrder->salesOrder->ppn, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">Grand Total</a>
                                <br>
                                <a>{{ number_format($invoice->deliveryOrder->salesOrder->gtotal, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <br>
                        <div class="card-action">
                            <a class="btn btn-back ml-auto addRow" href="/dashboard/invoice">
                                <span><i class="fa fa-chevron-left"> </i></span> Back
                            </a>
                            {{-- <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="/dashboard/purchaseorders" class="btn btn-danger">Cancel</a> --}}
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
