@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">{{ $title }}: {{ $purchaseOrder->id_purchaseorder }}</h4>
                                <div>
                                    @if ($purchaseOrder->status === 'Approved' || $purchaseOrder->status === 'Received')
                                        <a class="btn btn-danger btn-round ml-auto addRow"
                                            href="/dashboard/purchaseorders/{{ $purchaseOrder->id_purchaseorder }}/exportPDF"
                                            target="__blank">
                                            <span><i class="fa fa-file"> </i></span> Export PDF
                                        </a>
                                    @endif
                                    <a class="btn btn-danger btn-round"
                                        href="{{ asset('storage/' . $purchaseOrder->pricelist) }}"><span><i
                                                class="fa fa-file"></i></span> Price List</a>
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
                                        <th>Expired Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 50%">
                                            <a>{{ $purchaseOrder->tglCreate }}</a>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <a>{{ $purchaseOrder->tglExp }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="b">From</a> : <a>Medev Indo Makmur</a>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <a class="b">Principal</a> : <a>{{ $purchaseOrder->principal->nama }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a>Komplek Perkantoran Duta Merlin Blok B 46-47, Jl. Gajah Mada B 46-47, Jakarta
                                                Pusat</a>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <a>{{ $purchaseOrder->principal->alamat }}</a>
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
                                    @foreach ($purchaseOrder->purchaseOrderItem as $i)
                                        <tbody>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $i->part->kd_parts }}</td>
                                            <td>{{ $i->part->nama }}</td>
                                            <td>{{ $i->part->uom->nama }}</td>
                                            <td>{{ number_format($i->hargasat, 2, '.', ',') }}</td>
                                            <td>{{ $i->qty }}</td>
                                            <td>{{ number_format($i->hargatot, 2, '.', ',') }}</td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-12 float-left">
                                <a class="b">Note</a>

                                <a>: {{ $purchaseOrder->note }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">Amount</a>
                                <br>
                                <a>{{ number_format($purchaseOrder->amount, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">PPN</a>
                                <br>
                                <a>{{ number_format($purchaseOrder->ppn, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <div class="form-group form-floating-label">
                            <div class="col-md-2 float-right">
                                <a class="b">Grand Total</a>
                                <br>
                                <a>{{ number_format($purchaseOrder->gtotal, 2, '.', ',') }}</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">
                                            <a class="btn btn-back ml-auto addRow" href="/dashboard/purchaseorders">
                                                <span><i class="fa fa-chevron-left"> </i></span> Back
                                            </a>
                                        </th>
                                        @if (
                                            ($purchaseOrder->status === 'Outstanding' && auth()->user()->id === $purchaseOrder->user_id) ||
                                                ($purchaseOrder->status === 'Rejected' && auth()->user()->id === $purchaseOrder->user_id))
                                            <th style="width: 2%">
                                                {{-- <a>Ini Submit</a> --}}
                                                <form action="/dashboard/purchaseorders/{{ $purchaseOrder->id }}/submit"
                                                    method="POST"
                                                    onclick="return confirm('Are you sure to submit this purchase order?')">
                                                    @method('put')
                                                    @csrf
                                                    <button class="btn btn-success" type="submit"><span><i
                                                                class="fa fa-check">
                                                            </i></span> Sumbit</button>
                                                </form>
                                            </th>
                                        @endif
                                        @if (
                                            ($purchaseOrder->status === 'Outstanding' && auth()->user()->id === $purchaseOrder->user_id) ||
                                                ($purchaseOrder->status === 'Rejected' && auth()->user()->id === $purchaseOrder->user_id))
                                            <th>
                                                {{-- <a>Ini Cancel</a> --}}
                                                <form action="/dashboard/purchaseorders/{{ $purchaseOrder->id }}/cancel"
                                                    method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit"
                                                        onclick="return confirm('Are you sure to close this purchase order?')"><span><i
                                                                class="fa fa-times">
                                                            </i></span> Close</button>
                                                </form>
                                            </th>
                                        @endif
                                        @if ($purchaseOrder->status === 'Waiting for Approval' && auth()->user()->departement === 'Management')
                                            <th style="width: 2%">
                                                {{-- <a>Ini Approve</a> --}}
                                                <form action="/dashboard/purchaseorders/{{ $purchaseOrder->id }}/approved"
                                                    method="POST"
                                                    onclick="return confirm('Are you sure to approve this purchase order?')">
                                                    @method('put')
                                                    @csrf
                                                    <button class="btn btn-success" type="submit"><span><i
                                                                class="fa fa-check">
                                                            </i></span> Approved</button>
                                                </form>
                                            </th>
                                            <th>
                                                {{-- <a>Ini Reject</a> --}}
                                                <form action="/dashboard/purchaseorders/{{ $purchaseOrder->id }}/rejected"
                                                    method="POST"
                                                    onclick="return confirm('Are you sure to reject this purchase order?')">
                                                    @method('put')
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit"><span><i
                                                                class="fa fa-times">
                                                            </i></span> Reject</button>
                                                </form>
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
