@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/deliveryorders" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">{{ $title }}</h4>
                                </div>
                            </div>
                            {{-- ini bagian header --}}
                            <div class="table">
                                <table class="table" style="border-inline-end-color: white">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%">Sales Order</th>
                                            <th>Ship date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="iniSelect form-control" for="salesOrder_id"
                                                    id="salesOrder_id" name="salesOrder_id" required>
                                                    <option value="" selected>Select Sales Order</option>
                                                    @foreach ($salesOrders as $salesOrder)
                                                        @if (old('salesOrder_id') == $salesOrder->id)
                                                            <option value="{{ $salesOrder->id }}"
                                                                data-idWarehouse="{{ $salesOrder->warehouse_id }}"
                                                                data-idCustomer="{{ $salesOrder->customer_id }}"
                                                                data-alWh="{{ $salesOrder->warehouse->alamat }}"
                                                                data-alCust="{{ $salesOrder->customer->alamat }}"
                                                                data-filePo="{{ $salesOrder->pofile }}"
                                                                data-po="{{ $salesOrder->po }}">
                                                                {{ $salesOrder->id_salesOrder }}</option>
                                                        @else
                                                            <option value="{{ $salesOrder->id }}"
                                                                data-idWarehouse="{{ $salesOrder->warehouse_id }}"
                                                                data-idCustomer="{{ $salesOrder->customer_id }}"
                                                                data-alWh="{{ $salesOrder->warehouse->alamat }}"
                                                                data-alCust="{{ $salesOrder->customer->alamat }}"
                                                                data-filePo="{{ $salesOrder->pofile }}"
                                                                data-po="{{ $salesOrder->po }}">
                                                                {{ $salesOrder->id_salesOrder }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="date" name="shipdate" id="shipdate"
                                                    class="form-control @error('shipdate') is-invalid @enderror" required
                                                    value="{{ old('shipdate') }}"">
                                                @error('shipdate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="b">
                                                    Warehouse
                                                </a>
                                                <select class="fakeWhId form-control" for="fakeWarehouse_id"
                                                    id="fakeWarehouse_id" name="fakeWarehouse_id" required disabled>
                                                    <option value="">Select warehouse</option>
                                                    @foreach ($warehouses as $warehouse)
                                                        @if (old('fakeWarehouse_id') == $warehouse->id)
                                                            <option value="{{ $warehouse->id }}" selected>
                                                                {{ $warehouse->nama }}</option>
                                                        @else
                                                            <option value="{{ $warehouse->id }}">
                                                                {{ $warehouse->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <select class="form-control" for="warehouse_id" id="warehouse_id"
                                                    name="warehouse_id" required readonly hidden>
                                                    <option value="">Select warehouse</option>
                                                    @foreach ($warehouses as $warehouse)
                                                        @if (old('warehouse_id') == $warehouse->id)
                                                            <option value="{{ $warehouse->id }}" selected
                                                                data-alamatWh="{{ $warehouse->alamat }}">
                                                                {{ $warehouse->nama }}</option>
                                                        @else
                                                            <option value="{{ $warehouse->id }}"
                                                                data-alamatWh="{{ $warehouse->alamat }}">
                                                                {{ $warehouse->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <a class="b">
                                                    Ship to
                                                </a>
                                                <select class="fakeCustId form-control" for="fakeCustomer_id"
                                                    id="fakeCustomer_id" name="fakeCustomer_id" required disabled>
                                                    <option value="">Select customer</option>
                                                    @foreach ($customers as $customer)
                                                        @if (old('fakeCustomer_id') == $customer->id)
                                                            <option value="{{ $customer->id }}" selected>
                                                                {{ $customer->nama }}</option>
                                                        @else
                                                            <option value="{{ $customer->id }}">
                                                                {{ $customer->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <select class="form-control" for="customer_id" id="customer_id"
                                                    name="customer_id" required readonly hidden>
                                                    <option value="">Select customer</option>
                                                    @foreach ($customers as $customer)
                                                        @if (old('customer_id') == $customer->id)
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
                                                <textarea name="whAddress" id="whAddress" cols="55" rows="5" class="input-addressFBin" readonly required>{{ old('whAddress') }}</textarea>
                                                @error('whAddress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <textarea name="custAddress" id="custAddress" cols="55" rows="5" class="input-addressFBin" readonly required>{{ old('custAddress') }}</textarea>
                                                @error('custAddress')
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
                                                <th style="width: 15%">LOT</th>
                                                <th style="width: 15%">EXP DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody id="salesOrderItemsBody">
                                            {{-- isi woy --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group form-floating-label col-md-6 float-right">
                                    <a class="b">Note</a>
                                    <textarea class="form-control @error('note') is-invalid @enderror" required id="note" name="note"
                                        type="text" rows="5">{{ old('note') }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">Submit</button>
                                <a href="/dashboard/deliveryorders" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to cancel the form?')">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        //select2
        $(document).ready(function() {
            $('#salesOrder_id').select2();
            var elSalesOrder = $('#salesOrder_id');
            var elShipDate = $('#shipdate');
            var elWarehouse = $('#warehouse_id');
            var elShipTo = $('#customer_id');
            var elFakeWh = $('.fakeWhId')
            var elFakeCust = $('.fakeCustId')
            var elPo = $('#po')
            var elWhAddress = $('#whAddress')
            var elCustAddress = $('#custAddress')
            var elFilePo = $('#filePo')

            // Menambahkan event listener untuk perubahan pada select
            elSalesOrder.on('change', function() {
                var selectedOption = elSalesOrder.find(':selected');
                // var getAttrShipDate = selectedOption.attr('data-shipdate');
                var getAttrWarehouse = selectedOption.attr('data-idWarehouse');
                var getAttrAlWh = selectedOption.attr('data-alWh');
                var getAttrCustAl = selectedOption.attr('data-alCust');
                var getAttrShipTo = selectedOption.attr('data-idCustomer');
                var getAttrPo = selectedOption.attr('data-Po');
                var getAttrFilePo = selectedOption.attr('data-filePo');
                var storage = "/storage/";

                console.log(storage + getAttrFilePo);
                elWarehouse.val(getAttrWarehouse);
                elFakeWh.val(getAttrWarehouse);
                elShipTo.val(getAttrShipTo);
                elFakeCust.val(getAttrShipTo);
                elPo.val(getAttrPo);
                elWhAddress.val(getAttrAlWh);
                elCustAddress.val(getAttrCustAl);
                elFilePo.attr('href', storage + getAttrFilePo);
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#salesOrder_id').on('change', function() {
            var elSo = $(this).val();
            if (elSo > 0) {
                $.ajax({
                    type: 'POST',
                    url: '/dashboard/deliveryorders/getItemSo',
                    data: {
                        'valSo': elSo
                    },
                    success: function(response) {
                        // console.log(response);
                        $('#salesOrderItemsBody').html(response);
                    }
                });
            } else {
                $('#salesOrderItemsBody').empty();
            }
        });
    </script>
@endsection
