@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ 'Detail' }} {{ $goodReceipt->id_goodreceipt }}</h4>
                                <a class="btn btn-danger btn-round ml-auto addRow" target="__blank"
                                    href="/dashboard/goodreceipts/{{ $goodReceipt->id_goodreceipt }}/exportPDF">
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a>{{ $goodReceipt->tanggal }}</a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="b">Principal</a>
                                        </td>
                                        <td>
                                            <a class="b">Purchase Order</a>
                                        </td>
                                        <td>
                                            <a class="b">Delivery Order</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>{{ $goodReceipt->purchaseOrder->principal->nama }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $goodReceipt->purchaseOrder->id_purchaseorder }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $goodReceipt->suratjalan }}</a>
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
                                    @foreach ($goodReceipt->goodReceiptItem as $i)
                                        <tbody>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $i->part->kd_parts }}</td>
                                            <td>{{ $i->part->nama }}</td>
                                            <td>{{ $i->part->uom->nama }}</td>
                                            <td>{{ $i->qty }}</td>
                                            <td>{{ $i->lot->kd_lots }}</td>
                                            <td>{{ $i->lot->exp }}</td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-12 float-left">
                                <a class="b">Note</a>
                                <a>: {{ $goodReceipt->note }}</a>
                            </div>
                        </div>
                        <br>
                        <div class="card-action">
                            <a class="btn btn-back ml-auto addRow" href="/dashboard/goodreceipts">
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
