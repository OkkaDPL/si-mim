@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/salesorders" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">{{ $title }}</h4>
                                    <button id="addRowButton" class="btn btn-primary btn-round ml-auto addRow">
                                        <span><i class="fa fa-plus"></i></span> Add Row
                                    </button>
                                </div>
                            </div>
                            {{-- ini bagian header --}}
                            <div class="table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%">Sales Person</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="iniSelect2 form-control" name="employee_id" id="employee_id"
                                                    required>
                                                    <option value="">Select Sales Person</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}">{{ $employee->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="date" name="tanggal" id="tanggal"
                                                    class="form-control @error('tanggal') is-invalid @enderror"
                                                    value="{{ old('tanggal') }}" required>
                                                @error('tanggal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a class="b">Stock on</a></td>
                                            <td><a class="b">Bill to</a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="iniSelect2 form-control" name="bin_id" id="bin_id"
                                                    required>
                                                    <option value="">Select stock bin</option>
                                                    @foreach ($bins as $bin)
                                                        <option value="{{ $bin->id }}"
                                                            data-address="{{ $bin->alamat }}">
                                                            {{ $bin->customer->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="iniSelect2 form-control" name="customer_id" id="customer_id"
                                                    required disabled>
                                                    <option value="">Choose stock first</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a class="b">Stock on address</a></td>
                                            <td><a class="b">Bill to address</a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="addressBin" id="addressBin" cols="55" rows="5" class="input-addressFBin" readonly required>{{ old('addressBin') }}</textarea>
                                                @error('addressBin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <textarea name="addressCust" id="addressCust" cols="55" rows="5" class="input-addressFBin" readonly required>{{ old('addressCust') }}</textarea>
                                                @error('addressCust')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="b">PO</a>
                                            </td>
                                            <td>
                                                <a class="b">PO File</a> <a>*file type must PDF</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="po" id="po"
                                                    class="form-control @error('po') is-invalid @enderror"
                                                    value="{{ old('po') }}" required>
                                                @error('po')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="file" name="pofile" id="pofile"
                                                    class="form-control-file @error('pofile') is-invalid @enderror"
                                                    id="pofile" required>
                                                @error('pofile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a class="b">SIH</a> <a>*file type must PDF</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="file" name="sih" id="sih"
                                                    class="form-control-file @error('sih') is-invalid @enderror"
                                                    id="sih" required>
                                                @error('sih')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
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
                                                <th>ID</th>
                                                <th>Part</th>
                                                <th>Part Desc</th>
                                                <th>UOM</th>
                                                <th>Lot</th>
                                                <th>Exp</th>
                                                <th>Unit Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (old('inventory_id', ['']) as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="inventory_id[]" id="inventory_id"
                                                            class="cInvenId form-control input-border-bottom @error('inventory_id.' . $key) is-invalid @enderror"
                                                            list="list-invenId" value="{{ old('inventory_id.' . $key) }}"
                                                            required>
                                                        @error('inventory_id.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <datalist id="list-invenId">
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input id="iPart" name="iPart[]" type="text"
                                                            class="cPart form-control input-border-bottom " readonly
                                                            required value="{{ old('iPart.' . $key) }}">
                                                        @error('iPart.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="iPartDesc" name="iPartDesc[]" type="text"
                                                            class="cPartDesc form-control input-border-bottom" readonly
                                                            required value="{{ old('iPartDesc.' . $key) }}">
                                                        @error('iPartDesc.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="iUom" name="iUom[]" type="text"
                                                            class="cUom form-control input-border-bottom " readonly
                                                            required value="{{ old('iUom.' . $key) }}">
                                                        @error('iUom.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="iLot" name="iLot[]" type="text"
                                                            class="cLot form-control input-border-bottom " readonly
                                                            required value="{{ old('iLot.' . $key) }}">
                                                        @error('iLot.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="iExp" name="iExp[]" type="text"
                                                            class="cExp form-control input-border-bottom " readonly
                                                            required value="{{ old('iExp.' . $key) }}">
                                                        @error('iExp.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="hargasat" name="hargasat[]" type="text"
                                                            class="cHarsat form-control input-border-bottom"
                                                            value="{{ old('hargasat.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)" required>
                                                        @error('hargasat.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="qty" name="qty[]" type="text"
                                                            class="cQty form-control input-border-bottom"
                                                            value="{{ old('qty.' . $key) }}" pattern="[0-9]{1,5}"
                                                            onkeyup="calculateTotal(this)">
                                                        @error('qty.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        {{-- fakeqty --}}
                                                        <input id="iFakeQty" name="iFakeQty[]" type="number"
                                                            class="cFakeQty form-control input-border-bottom"
                                                            value="{{ old('iFakeQty.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)" required
                                                            hidden>
                                                    </td>
                                                    <td>
                                                        <input id="hargatot" name="hargatot[]" type="text"
                                                            class="cHartot form-control input-border-bottom"
                                                            value="{{ old('hargatot.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)" required
                                                            readonly>
                                                        @error('hargatot.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
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
                            <div class="form-group form-floating-label">
                                <div class="col-md-3 float-right">
                                    <a class="b">Amount</a>
                                    <input id="amount" name="amount" type="text"
                                        class="cAmount form-control input-border-bottom @error('amount') is-invalid @enderror"
                                        required value="{{ old('amount') }}"
                                        onkeyup="formatNumber(this); calculateTotal()" readonly>
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
                                        class="cPpn form-control input-border-bottom @error('ppn') is-invalid @enderror"
                                        required value="{{ old('ppn') }}"
                                        onkeyup="formatNumber(this); calculateTotal()" readonly>
                                    @error('ppn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-floating-label">
                                <div class="col-md-3 float-right">
                                    <a class="b">Grand Total</a>
                                    <input id="gtotal" name="gtotal" type="text"
                                        class="cGtot form-control input-border-bottom @error('gtotal') is-invalid @enderror"
                                        value="{{ old('gtotal') }}" onkeyup="formatNumber(this); calculateTotal()"
                                        readonly>
                                    @error('gtotal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">
                                    Submit
                                </button>
                                <a href="/dashboard/purchaseorders" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.iniSelect2').select2({
                width: '100%'
            });

            $(document).on('input', '.cQty', function() {
                validateQty($(this));
            });

            function validateQty(input) {
                var qtyInput = parseInt(input.val());
                var fakeQtyInput = parseInt(input.closest('tr').find('.cFakeQty').val());

                if (qtyInput > fakeQtyInput) {
                    input[0].setCustomValidity("Out of stock!");
                } else if (qtyInput === 0) {
                    input[0].setCustomValidity("Min 1!");
                } else {
                    input[0].setCustomValidity("");
                }
            }

            var stockOn = $('#bin_id');
            var stockAddress = $('#addressBin');
            var billTo = $('#customer_id');
            var billAddress = $('#addressCust');
            var idInven = $('.cInvenId');
            var elPart = $('.cPart');
            var elPartDesc = $('.cPartDesc');
            var elUom = $('.cUom');
            var elLot = $('.cLot');
            var elExp = $('.cExp');
            var elQty = $('.cQty');
            var elFakeQty = $('.cFakeQty');
            var elHarsat = $('.cHarsat');
            var elHartot = $('.cHartot');

            function clearIdChange() {
                $('#iPart').val('');
                $('#iPartDesc').val('');
                $('#iUom').val('');
                $('#iLot').val('');
                $('#iFakeQty').val('');
                $('#iExp').val('');
                $('#iQty').val('');
                $('#hargasat').val('');
                $('#hargatot').val('');
            }

            function clearStockOnChange() {
                $('.cInvenId').val('');
                $('#addressCust').val('');
                $('.cPart').val('');
                $('.cPartDesc').val('');
                $('.cUom').val('');
                $('.cLot').val('');
                $('.cFakeQty').val('');
                $('.cExp').val('');
                $('.cQty').val('');
                $('.cHarsat').val('');
                $('.cHartot').val('');
            }

            idInven.on('input', function() {
                // clearIdChange();
                var thisVal = $(this).val();
                var selectedOption = $('#list-invenId option[value="' + thisVal +
                    '"]');

                var duplicate = false;
                $('.cInvenId').not($(this)).each(function() {
                    if ($(this).val() === thisVal) {
                        duplicate = true;
                        return false;
                    }
                });

                if (duplicate) {
                    this.setCustomValidity("ID already exist in another row!");
                } else {
                    this.setCustomValidity("");
                }
                var getAttrPart = selectedOption.attr('data-kdParts');
                var getAttrPartDesc = selectedOption.data('desc');
                var getAttrUom = selectedOption.data('uom');
                var getAttrLot = selectedOption.data('lot');
                var getAttrExp = selectedOption.data('exp');
                var getAttrQty = selectedOption.data('qty');

                elPart.val(getAttrPart);
                elPartDesc.val(getAttrPartDesc);
                elUom.val(getAttrUom);
                elLot.val(getAttrLot);
                elExp.val(getAttrExp);
                elQty.val(getAttrQty);
                elFakeQty.val(getAttrQty);
                // console.log(getAttrPart);
            });

            stockOn.on('change', function() {
                clearStockOnChange();
                var selectOption = $(this).find(
                    'option:selected');
                var getAttribut = selectOption.data('address');
                stockAddress.val(getAttribut);

                var triggerStockOn = $(this).val();
                // console.log(triggerStockOn);
                if (triggerStockOn > 0) {
                    billTo.prop('disabled', false);
                    $.ajax({
                        url: '/dashboard/salesorders/getCustomer',
                        type: 'POST',
                        data: {
                            'getCustomer': triggerStockOn,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            billTo.html('');
                            // console.log(result);
                            $("#customer_id").append(
                                '<option value="" selected>' + 'Select Cust' +
                                '</option>'
                            );
                            // billTo.prop('disabled', false);
                            $.each(result.getArrCust, function(key, value) {
                                var custId = value.id;
                                var custNama = value.nama;
                                var custAlamat = value.alamat;
                                $("#customer_id").append(
                                    '<option value="' + custId +
                                    '" data-address="' +
                                    custAlamat + '" >' + custNama +
                                    '</option>'
                                );
                                // billAddress.val(custAlamat);
                            });
                        }
                    });
                } else {
                    billTo.html('<option value="">Choose stock first</option>');
                    billTo.prop('disabled', true);
                }
                $.ajax({
                    url: '/dashboard/salesorders/triggedStockOn',
                    type: 'POST',
                    data: {
                        'getInventoryId': triggerStockOn,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#list-invenId").html('');
                        // console.log(result);
                        $.each(result.InventoryTriggedStockOn, function(key, value) {
                            var invenPartId = value.part_id;
                            var invenId = value.id;
                            var invenQty = value.qty;
                            var partInven_nama = value.part.nama;
                            var partInven_id = value.part_id;
                            var lotInven_id = value.lot_id;
                            var partInven_kdParts = value.part.kd_parts;
                            var uomInven_nama = value.part.uom.nama;
                            var lotInven_kdLot = value.lot.kd_lots;
                            var lotInven_exp = value.lot.exp;
                            $("#list-invenId").append('<option value="' +
                                invenId +
                                '" data-part="' + invenPartId + '" lotId="' +
                                lotInven_id + '" partId="' +
                                partInven_id +
                                '" data-desc="' + partInven_nama +
                                '" data-kdParts="' +
                                partInven_kdParts + '" data-uom="' +
                                uomInven_nama + '" data-qty="' +
                                invenQty + '" data-exp="' +
                                lotInven_exp +
                                '" data-lot="' +
                                lotInven_kdLot + '">' + 'Part : ' +
                                partInven_nama +
                                ',   LOT : ' + lotInven_kdLot +
                                '</option>');
                        });
                    }
                });
            });

            billTo.on('change', function() {
                var selectOption = $(this).find(
                    'option:selected');
                // console.log(selectOption);
                var getAttribut = selectOption.data('address');
                billAddress.val(getAttribut);
            });

            $('#addRowButton').click(function() {
                var newRow = '<tr>' +
                    '<td>' +
                    '<input type="text" name="inventory_id[]" class="cInvenId form-control input-border-bottom" list="list-invenId" required>' +
                    '<datalist id="list-invenId"></datalist>' +
                    '</td>' +
                    '<td>' +
                    '<input  name="iPart[]" type="text" class="cPart form-control input-border-bottom" readonly required>' +
                    '</td>' +
                    '<td>' +
                    '<input name="iPartDesc[]" type="text" class="cPartDesc form-control input-border-bottom" readonly required>' +
                    '</td>' +
                    '<td>' +
                    '<input name="iUom[]" type="text" class="cUom form-control input-border-bottom" readonly required>' +
                    '</td>' +
                    '<td>' +
                    '<input name="iLot[]" type="text" class="cLot form-control input-border-bottom" readonly required>' +
                    '</td>' +
                    '<td>' +
                    '<input name="iExp[]" type="text" class="cExp form-control input-border-bottom" readonly required>' +
                    '</td>' +
                    '<td>' +
                    '<input name="hargasat[]" type="text" class="cHarsat form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" required>' +
                    '</td>' +
                    '<td>' +
                    '<input name="qty[]" type="text" class="cQty form-control input-border-bottom" pattern="[0-9]{1,5}" onkeyup="calculateTotal(this)" required>' +
                    '<input name="fakeQty[]" type="number" class="cFakeQty form-control input-border-bottom" required hidden>' +
                    '</td>' +
                    '<td>' +
                    '<input name="hargatot[]" type="text" class="cHartot form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" required readonly>' +
                    '</td>' +
                    '</td>' +
                    '<td><button type="button" class="btn btn-danger removeRow"><span><i class="flaticon-interface-5"></i></span></button></td>' +
                    '</tr>';

                $('#parts_table tbody').append(newRow);
                var newRowElement = $('#parts_table tbody tr:last');
                newRowElement.find('.cInvenId').on('input', function() {
                    var thisVal = $(this).val();
                    var selectedOption = $('#list-invenId option[value="' + thisVal + '"]');

                    var duplicate = false;
                    $('.cInvenId').not($(this)).each(function() {
                        if ($(this).val() === thisVal) {
                            duplicate = true;
                            return false;
                        }
                    });

                    if (duplicate) {
                        this.setCustomValidity("ID already exist in another row!");
                    } else {
                        this.setCustomValidity("");
                    }

                    var getAttrPart = selectedOption.attr('data-kdParts');
                    var getAttrPartDesc = selectedOption.data('desc');
                    var getAttrUom = selectedOption.data('uom');
                    var getAttrLot = selectedOption.data('lot');
                    var getAttrExp = selectedOption.data('exp');
                    var getAttrQty = selectedOption.data('qty');

                    newRowElement.find('.cPart').val(getAttrPart);
                    newRowElement.find('.cPartDesc').val(getAttrPartDesc);
                    newRowElement.find('.cUom').val(getAttrUom);
                    newRowElement.find('.cLot').val(getAttrLot);
                    newRowElement.find('.cExp').val(getAttrExp);
                    newRowElement.find('.cQty').val(getAttrQty);
                    newRowElement.find('.cFakeQty').val(getAttrQty);
                });
            });
            $("#parts_table").on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });
        });

        // removeRow.on('click', function() {
        //     $(this).closest('tr').remove();
        // });

        function formatNumber(input) {
            // Menghapus koma dari nilai input sebelum memformat angka
            var value = input.value.replace(/,/g, '');

            // Memformat angka dengan menambahkan koma setiap 3 digit
            value = parseFloat(value).toLocaleString();

            // Memasukkan kembali nilai yang telah diformat ke input
            input.value = value;
        }

        function calculateTotal(input) {
            var row = input.parentNode.parentNode; // Mendapatkan baris (tr) tempat input berada
            var hargasatInput = row.querySelector('[name="hargasat[]"]');
            var qtyInput = row.querySelector('[name="qty[]"]');
            var hargatotInput = row.querySelector('[name="hargatot[]"]');
            var amountInput = document.getElementById('amount');
            var ppnInput = document.getElementById('ppn');
            var gtotalInput = document.getElementById('gtotal');

            var hargasatValue = parseFloat(hargasatInput.value.replace(/,/g, ''));
            var qtyValue = parseFloat(qtyInput.value.replace(/,/g, ''));
            var amountValue = parseFloat(amountInput.value.replace(/,/g, ''));
            var ppnValue = parseFloat(ppnInput.value.replace(/,/g, ''));

            var hargatotValue = hargasatValue * qtyValue;
            hargatotInput.value = hargatotValue.toLocaleString();

            // Menghitung jumlah total dari seluruh input hargatot
            var total = 0;
            var hargatotInputs = document.querySelectorAll('[name="hargatot[]"]');
            hargatotInputs.forEach(function(input) {
                var value = parseFloat(input.value.replace(/,/g, ''));
                if (!isNaN(value)) {
                    total += value;
                }
            });
            amountInput.value = total.toLocaleString();

            // Menghitung nilai PPN 11%
            var ppnValue = total * 0.11;
            ppnInput.value = ppnValue.toLocaleString();

            //menghitung gtotal
            // console.log(total, ppnValue);
            var gtotalValue = total + ppnValue;
            // console.log(gtotalValue);
            gtotalInput.value = gtotalValue.toLocaleString();
        }
    </script>
@endsection
