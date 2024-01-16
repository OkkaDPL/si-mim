@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ 'Detail' }} {{ $inventoryTransfer->id_inventoryTransfer }}
                                </h4>
                                <a class="btn btn-danger btn-round ml-auto addRow" target="__blank"
                                    href="/dashboard/inventorytransfer/{{ $inventoryTransfer->id_inventoryTransfer }}/exportPDF">
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
                                        <th>Ship Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a>{{ $inventoryTransfer->shipdate }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $inventoryTransfer->shipdate }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="b">From</a> :
                                            <a>{{ $inventoryTransfer->fromBin->customer->nama }}</a>
                                        </td>
                                        <td>
                                            <a class="b">To</a> :
                                            <a>{{ $inventoryTransfer->toBin->customer->nama }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>{{ $inventoryTransfer->fromBin->customer->alamat }}</a>
                                        </td>
                                        <td>
                                            <a>{{ $inventoryTransfer->toBin->customer->alamat }}</a>
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
                                    @foreach ($inventoryTransfer->inventoryTransferItem as $i)
                                        <tbody>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $i->inventory->part->kd_parts }}</td>
                                            <td>{{ $i->inventory->part->nama }}</td>
                                            <td>{{ $i->inventory->part->uom->nama }}</td>
                                            <td>{{ $i->qty }}</td>
                                            <td>{{ $i->inventory->lot->kd_lots }}</td>
                                            <td>{{ $i->inventory->lot->exp }}</td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-12 float-left">
                                <a class="b">Note</a>
                                <a>: {{ $inventoryTransfer->note }}</a>
                            </div>
                        </div>
                        <br>
                        <div class="card-action">
                            <a class="btn btn-back ml-auto addRow" href="/dashboard/inventorytransfer">
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
