@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/invoice" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">{{ $title }}</h4>
                                    <div>
                                        <a class="btn btn-danger btn-round" href="#" id="fileSih"><span><i
                                                    class="fa fa-file">
                                                </i></span> SIH</a>
                                    </div>
                                </div>
                            </div>
                            {{-- ini bagian header --}}
                            <div class="table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%">Delivery Order</th>
                                            <th>Invoice date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="iniSelect form-control" for="deliveryOrder_id"
                                                    id="deliveryOrder_id" name="deliveryOrder_id" required>
                                                    <option value="" selected>Select Delivery Order</option>
                                                    @foreach ($deliveryOrder as $deliveryOrder)
                                                        @if (old('deliveryOrder_id') == $deliveryOrder->id)
                                                            <option value="{{ $deliveryOrder->id }}"
                                                                data-tanggal="{{ $deliveryOrder->tanggal }}"
                                                                data-fromId="{{ $deliveryOrder->salesOrder->warehouse_id }}"
                                                                data-customer="{{ $deliveryOrder->salesOrder->customer_id }}"
                                                                data-frAddress="{{ $deliveryOrder->salesOrder->warehouse->alamat }}"
                                                                data-toAddress="{{ $deliveryOrder->salesOrder->customer->alamat }}"
                                                                data-note="{{ $deliveryOrder->note }}"
                                                                data-po="{{ $deliveryOrder->salesOrder->po }}"
                                                                data-pofile="{{ $deliveryOrder->salesOrder->pofile }}"
                                                                data-sihfile="{{ $deliveryOrder->salesOrder->sih }}"
                                                                data-amount="{{ number_format($deliveryOrder->salesOrder->amount, 2, ',', '.') }}"
                                                                data-ppn="{{ number_format($deliveryOrder->salesOrder->ppn, 2, ',', '.') }}"
                                                                data-gtotal="{{ number_format($deliveryOrder->salesOrder->gtotal, 2, ',', '.') }}">
                                                                {{ $deliveryOrder->id_deliveryOrder }}</option>
                                                        @else
                                                            <option value="{{ $deliveryOrder->id }}"
                                                                data-tanggal="{{ $deliveryOrder->tanggal }}"
                                                                data-fromId="{{ $deliveryOrder->salesOrder->warehouse_id }}"
                                                                data-customer="{{ $deliveryOrder->salesOrder->customer_id }}"
                                                                data-frAddress="{{ $deliveryOrder->salesOrder->warehouse->alamat }}"
                                                                data-toAddress="{{ $deliveryOrder->salesOrder->customer->alamat }}"
                                                                data-note="{{ $deliveryOrder->note }}"
                                                                data-po="{{ $deliveryOrder->salesOrder->po }}"
                                                                data-pofile="{{ $deliveryOrder->salesOrder->pofile }}"
                                                                data-sihfile="{{ $deliveryOrder->salesOrder->sih }}"
                                                                data-amount="{{ number_format($deliveryOrder->salesOrder->amount, 2, ',', '.') }}"
                                                                data-ppn="{{ number_format($deliveryOrder->salesOrder->ppn, 2, ',', '.') }}"
                                                                data-gtotal="{{ number_format($deliveryOrder->salesOrder->gtotal, 2, ',', '.') }}">
                                                                {{ $deliveryOrder->id_deliveryOrder }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="date" name="tanggal" id="tanggal"
                                                    class="form-control @error('tanggal') is-invalid @enderror" disabled
                                                    value="{{ old('tanggal') }}"">
                                                @error('tanggal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="b">
                                                    From
                                                </a>
                                            </td>
                                            <td>
                                                <a class="b">
                                                    Bill to
                                                </a>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" id="from" name="from" required
                                                    disabled>
                                                    <option value="">Choose delivery order first</option>
                                                    @foreach ($warehouses as $warehouse)
                                                        @if (old('from') == $warehouse->id)
                                                            <option value="{{ $warehouse->id }}" selected>
                                                                {{ $warehouse->namaPt }}</option>
                                                        @else
                                                            <option value="{{ $warehouse->id }}">
                                                                {{ $warehouse->namaPt }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" id="customer" name="customer" required
                                                    disabled>
                                                    <option value="">Choose delivery order first</option>
                                                    @foreach ($customers as $customer)
                                                        @if (old('customer') == $customer->id)
                                                            <option value="{{ $customer->id }}" selected>
                                                                {{ $customer->nama }}</option>
                                                        @else
                                                            <option value="{{ $customer->id }}">
                                                                {{ $customer->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="fromAddress" id="fromAddress" cols="55" rows="5" class="input-addressFBin" readonly required>{{ old('fromAddress') }}</textarea>
                                                @error('fromAddress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <textarea name="toAddress" id="toAddress" cols="55" rows="5" class="input-addressFBin" readonly required>{{ old('toAddress') }}</textarea>
                                                @error('toAddress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><a class="b">Purchase Order</a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-control" type="text" id="po" name="po"
                                                    disabled>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" href="#" id="filePo">
                                                    <span><i class="fa fa-file"></i></span>
                                                    File</a>
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
                                                <th style="width: 20%">Part</th>
                                                <th>Part Desc</th>
                                                <th style="width: 10%">UOM</th>
                                                <th style="width: 10%">Qty</th>
                                                <th style="width: 15%">Unit Price</th>
                                                <th style="width: 15%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoiceItemBody">
                                            {{-- isi woy --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group form-floating-label col-md-6 float-right">
                                    <a class="b">Note</a>
                                    <textarea class="form-control @error('note') is-invalid @enderror" required id="note" name="note"
                                        type="text" rows="5" readonly>{{ old('note') }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-floating-label">
                                <div class="col-md-3 float-right">
                                    <a class="b">Amount</a>
                                    <input id="amount" name="amount" type="text"
                                        class="form-control input-border-bottom @error('amount') is-invalid @enderror"
                                        required readonly value="{{ old('amount') }}">
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-floating-label">
                                <div class="col-md-3 float-right">
                                    <a class="b">PPN 11%</a>
                                    <input id="ppn" name="ppn" type="text"
                                        class="form-control input-border-bottom @error('ppn') is-invalid @enderror"
                                        required readonly value="{{ old('ppn') }}">
                                    @error('ppn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-floating-label">
                                <div class="col-md-3 float-right">
                                    <a class="b">Grand total</a>
                                    <input id="gtotal" name="gtotal" type="text"
                                        class="form-control input-border-bottom @error('gtotal') is-invalid @enderror"
                                        value="{{ old('gtotal') }}" required readonly>
                                    @error('gtotal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">Submit</button>
                                <a href="/dashboard/invoice" class="btn btn-danger">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#deliveryOrder_id').select2();
            var elDeliveryOrder = $('#deliveryOrder_id');
            var elTanggal = $('#tanggal');
            var elTanggal = $('#tanggal');
            var elFrom = $('#from');
            var elBillTo = $('#customer');
            var elAmount = $('#amount');
            var elPpn = $('#ppn');
            var elGtotal = $('#gtotal');
            var elNote = $('#note');
            var elFrAddress = $('#fromAddress');
            var elToAddress = $('#toAddress');
            var elPo = $('#po');
            var elFilePo = $('#filePo');
            var elFileSih = $('#fileSih');

            // // Menambahkan event listener untuk perubahan pada select
            elDeliveryOrder.on('change', function() {
                var valElDo = $(this).val();

                // console.log(valElDo);

                var selectedOption = elDeliveryOrder.find('option:selected');
                var getAttrTanggal = selectedOption.data('tanggal');
                var getAttrFrom = selectedOption.attr('data-fromId');
                var getAttrCust = selectedOption.attr('data-customer');
                var getAttrAmount = selectedOption.attr('data-amount');
                var getAttrPpn = selectedOption.attr('data-ppn');
                var getAttrGtotal = selectedOption.attr('data-gtotal');
                var getAttrNote = selectedOption.attr('data-note');
                var getAttrFrAddress = selectedOption.attr('data-frAddress');
                var getAttrToAddress = selectedOption.attr('data-toAddress');
                var getAttrPo = selectedOption.attr('data-po');
                var getAttrPoFile = selectedOption.attr('data-pofile');
                var getAttrSihFile = selectedOption.attr('data-sihfile');
                var storage = "/storage/"

                console.log(storage);

                elTanggal.val(getAttrTanggal)
                elFrom.val(getAttrFrom)
                elBillTo.val(getAttrCust)
                elAmount.val(getAttrAmount)
                elPpn.val(getAttrPpn)
                elGtotal.val(getAttrGtotal)
                elNote.val(getAttrNote)
                elFrAddress.val(getAttrFrAddress)
                elToAddress.val(getAttrToAddress)
                elPo.val(getAttrPo)
                elFileSih.attr('href', storage + getAttrSihFile)
                elFilePo.attr('href', storage + getAttrPoFile)

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (valElDo > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '/dashboard/invoice/getItemInvoice',
                        data: {
                            'valDo': valElDo
                        },
                        success: function(response) {
                            // console.log(response);
                            $('#invoiceItemBody').html(response);
                        }
                    });
                } else {
                    $('#invoiceItemBody').empty();
                }
            });
        });
    </script>
@endsection
