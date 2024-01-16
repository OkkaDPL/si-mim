@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/inventorytransfer" method="POST">
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
                                            <th style="width: 35%">From</th>
                                            <th style="width: 35%">To</th>
                                            <th>Ship Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="fakeFBin_id" id="fakeFBin_id"
                                                    class="triggerFBin form-control input-border-bottom @error('fakeFBin_id') is-invalid @enderror"
                                                    list="list-addressFBin" value="{{ old('fakeFBin_id') }}"
                                                    placeholder="From" required>
                                                @error('fakeFBin_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <datalist id="list-addressFBin">
                                                    <option value="" selected></option>
                                                    @foreach ($bins as $bin)
                                                        @if (old('fakeFBin_id') == $bin->id_bins)
                                                            <option value="{{ $bin->customer->nama }}"
                                                                data-fBinId="{{ $bin->id }}"
                                                                data-fBinAddress="{{ $bin->alamat }}" selected>
                                                                {{ $bin->id_bins }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $bin->customer->nama }}"
                                                                data-fBinId="{{ $bin->id }}"
                                                                data-fBinAddress="{{ $bin->alamat }}">
                                                                {{ $bin->id_bins }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </datalist>

                                                <input type="text" name="fromBin_id" id="fromBin_id"
                                                    value="{{ old('fromBin_id') }}" required hidden>
                                            </td>
                                            <td>
                                                <input type="text" name="fakeTBin_id" id="fakeTBin_id"
                                                    class="triggerTBin form-control input-border-bottom @error('fakeTBin_id') is-invalid @enderror"
                                                    list="list-addressTBin" value="{{ old('fakeTBin_id') }}"
                                                    placeholder="To" required>
                                                @error('fakeTBin_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <datalist id="list-addressTBin">
                                                    <option value="" selected></option>
                                                    @foreach ($rBins as $rBin)
                                                        @if (old('fakeTBin_id') == $rBin->id_bins)
                                                            <option value="{{ $rBin->customer->nama }}"
                                                                data-tBinId="{{ $rBin->id }}"
                                                                data-tBinAddress="{{ $rBin->alamat }}" selected>
                                                                {{ $rBin->id_bins }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $rBin->customer->nama }}"
                                                                data-tBinId="{{ $rBin->id }}"
                                                                data-tBinAddress="{{ $rBin->alamat }}">
                                                                {{ $rBin->id_bins }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </datalist>
                                                <input type="text" name="toBin_id" id="toBin_id"
                                                    value="{{ old('toBin_id') }}" required hidden>
                                            </td>
                                            <td>
                                                <input type="date" name="shipdate" id="shipdate"
                                                    class="form-control @error('shipdate') is-invalid @enderror" required
                                                    value="{{ old('shipdate') }}">
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
                                                    From Address
                                                </a>
                                            </td>
                                            <td>
                                                <a class="b">
                                                    To Address
                                                </a>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="fAddressBin" id="fAddressBin" cols="40" rows="5" class="input-addressFBin" readonly required>{{ old('fAddressBin') }}</textarea>
                                                @error('fAddressBin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <textarea name="tAddressBin" id="tAddressBin" cols="40" rows="5" class="input-addressTBin" readonly></textarea>
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
                                                <th>ID</th>
                                                <th>Part</th>
                                                <th>Desc</th>
                                                <th>UOM</th>
                                                <th>QTY</th>
                                                <th>LOT</th>
                                                <th>Expired Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (old('inventory_id', ['']) as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="inventory_id[]" id="inventory_id"
                                                            class="inventoryId form-control input-border-bottom @error('inventory_id.' . $key) is-invalid @enderror"
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
                                                            class="form-control input-border-bottom " readonly required
                                                            value="{{ old('iPart.' . $key) }}">
                                                        @error('iPart.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        {{-- part id --}}
                                                        <input id="part_id" name="part_id[]" type="text"
                                                            class="form-control input-border-bottom " required hidden
                                                            value="{{ old('part_id.' . $key) }}">
                                                        @error('part_id.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="iDesc" name="iDesc[]" type="text"
                                                            class="form-control input-border-bottom " readonly required
                                                            value="{{ old('iDesc.' . $key) }}">
                                                        @error('iDesc.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        {{-- bin_id --}}
                                                        <input id="bin_id" name="bin_id[]" type="text"
                                                            class="form-control input-border-bottom "
                                                            value="{{ old('bin_id.' . $key) }}" hidden>
                                                        @error('bin_id.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="iUom" name="iUom[]" type="text"
                                                            class="form-control input-border-bottom " disabled
                                                            value="{{ old('iUom.' . $key) }}">
                                                        @error('iUom.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="qty" name="qty[]" type="number"
                                                            min="1" max="#fakeQty"
                                                            class="qty form-control input-border-bottom"
                                                            value="{{ old('qty.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)">
                                                        @error('qty.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        {{-- fakeqty --}}
                                                        <input id="fakeQty" name="fakeQty[]" type="number"
                                                            class="fakeQty form-control input-border-bottom "
                                                            value="{{ old('fakeQty.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)" required
                                                            hidden>
                                                        @error('fakeQty.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="iLot" name="iLot[]" type="text"
                                                            class="form-control input-border-bottom " disabled
                                                            value="{{ old('iLot.' . $key) }}">
                                                        @error('iLot.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        {{-- lot id --}}
                                                        <input id="lot_id" name="lot_id[]" type="text"
                                                            class="form-control input-border-bottom " required
                                                            value="{{ old('lot_id.' . $key) }}" hidden>
                                                        @error('lot_id.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="iExpDate" name="iExpDate[]" type="date"
                                                            class="form-control input-border-bottom " disabled
                                                            value="{{ old('iExpDate.' . $key) }}">
                                                        @error('iExpDate.' . $key)
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
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">
                                    Submit
                                </button>
                                <a href="/dashboard/inventorytransfer" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            //autofill input address & hidden formBin_id

            $(document).on('input', '.qty', function() {
                validateQty($(this));
            });

            function validateQty(input) {
                var qtyInput = parseInt(input.val());
                var fakeQtyInput = parseInt(input.closest('tr').find('.fakeQty').val());

                if (qtyInput > fakeQtyInput) {
                    input[0].setCustomValidity("Out of stock!");
                } else {
                    input[0].setCustomValidity("");
                }
            }
            //mendapatkan setiap form yang ingin dipakai
            var triggerFBinInput = $('#fakeFBin_id');
            var fBinIdInput = $('#fromBin_id');
            var fAddressBinInput = $('#fAddressBin');
            var inventoryIdInput = $('#inventory_id');
            var binIdInput = $('#bin_id');
            var iDescInput = $('#iDesc');
            var iPartInput = $('#iPart');
            var partIdInput = $('#part_id');
            var binIdInput = $('#bin_id');
            var lotIdInput = $('#lot_id');
            var iUomInput = $('#iUom');
            var qtyInput = $('#qty');
            var fakeQtyInput = $('#fakeQty');
            var iLotInput = $('#iLot');
            var iExpDateInput = $('#iExpDate');

            $('#fakeTBin_id, #fakeFBin_id').on('input', function() {
                var fakeTBinId = $('#fakeTBin_id').val();
                var fakeFBinId = $('#fakeFBin_id').val();
                var tBinOptions = $('#list-addressTBin option');
                var fBinOptions = $('#list-addressFBin option');
                var isValidTBin = false;
                var isValidFBin = false;
                var tBinErrorMessage = '';
                var fBinErrorMessage = '';

                if (fakeTBinId === fakeFBinId) {
                    tBinErrorMessage = 'This input value must not be the same as the input value from.';
                } else {
                    tBinOptions.each(function() {
                        if ($(this).val() === fakeTBinId) {
                            isValidTBin = true;
                            return false; // Berhenti iterasi jika ditemukan
                        }
                    });

                    if (!isValidTBin) {
                        tBinErrorMessage = 'This data does not exist.';
                    }
                }

                fBinOptions.each(function() {
                    if ($(this).val() === fakeFBinId) {
                        isValidFBin = true;
                        return false; // Berhenti iterasi jika ditemukan
                    }
                });

                if (!isValidFBin) {
                    fBinErrorMessage = 'This data does not exist.';
                }

                $('#fakeTBin_id')[0].setCustomValidity(tBinErrorMessage);
                $('#fakeFBin_id')[0].setCustomValidity(fBinErrorMessage);
            });

            function clearInputValue() {
                $('#inventory_id').val('');
                $('#iDesc').val('');
                $('#part_id').val('');
                $('#bin_id').val('');
                $('#lot_id').val('');
                $('#iUom').val('');
                $('#qty').val('');
                $('#iLot').val('');
                $('#iPart').val('');
                $('#iExpDate').val('');
            }

            function clearInputTBin() {
                $('#fakeTBin_id').val('');
                $('#toBin_id').val('');
                $('#bin_id').val('');
                $('.binId').val('');
                $('#tAddressBin').val('');
            }
            //action jika terjadi perubahan
            triggerFBinInput.on('change', function() {
                clearInputValue();
                var selectedOption = $('#list-addressFBin option[value="' + $(this).val() +
                    '"]');
                var getBinId = selectedOption.attr('data-fBinId');
                // var selectBin = $('#list-addressTBin option[value="' + $(this).val() + '"]');

                fakeQtyInput.val('');
                fBinIdInput.val(selectedOption.attr('data-fBinId'));
                fAddressBinInput.val(selectedOption.attr('data-fBinAddress'));

                // $("#list-invenId").html('');
                $.ajax({
                    url: '/dashboard/inventorytransfer/triggedBin',
                    type: "POST",
                    data: {
                        get_bin: getBinId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#list-invenId").html('');
                        $.each(result.inventoryTriggedBin, function(key, value) {
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
                $('#inventory_id').on('input', function() {
                    var inputVal = $(this).val();
                    var selectedOption = $('#list-invenId option[value="' + inputVal +
                        '"]');

                    var duplicate = false;
                    $('.inventoryId').not($(this)).each(function() {
                        if ($(this).val() === inputVal) {
                            duplicate = true;
                            return false;
                        }
                    });

                    if (duplicate) {
                        this.setCustomValidity("This part desc already exist in another row!");
                    } else {
                        this.setCustomValidity("");
                    }

                    var dataDesc = selectedOption.attr('data-desc');
                    var dataPartId = selectedOption.attr('partId');
                    var dataLotId = selectedOption.attr('lotId');
                    var datakdPart = selectedOption.attr('data-kdParts');
                    var dataUom = selectedOption.attr('data-uom');
                    var dataQty = selectedOption.attr('data-qty');
                    var dataLot = selectedOption.attr('data-lot');
                    var dataExp = selectedOption.attr('data-exp');
                    // console.log(dataLot);
                    $('#iPart').val(datakdPart);
                    $('#part_id').val(dataPartId);
                    $('#lot_id').val(dataLotId);
                    $('#iDesc').val(dataDesc);
                    $('#iUom').val(dataUom);
                    $('#qty').val(dataQty);
                    $('#fakeQty').val(dataQty);
                    $('#iLot').val(dataLot);
                    $('#iExpDate').val(dataExp);

                });
            });

            //action triggerFBinInput jika valuenya = 0
            triggerFBinInput.on('input', function() {
                if ($(this).val() === '') {
                    fBinIdInput.val('');
                    // fAddressBinInput.val('');
                    inventoryIdInput.val('');
                    iPartInput.val('');
                    iDescInput.val('');
                    iUomInput.val('');
                    qtyInput.val('');
                    fakeQtyInput.val('');
                    iLotInput.val('');
                    iExpDateInput.val('');
                }
            });

            //autofill input address & hidden toBinid

            //mendapatkan setiap form yang ingin dipakai
            var triggerTBinInput = $('#fakeTBin_id');
            var tBinIdInput = $('#toBin_id');
            var tAddressBinInput = $('#tAddressBin');
            var binIdInput = $('#bin_id');

            //action perubahan
            triggerTBinInput.on('change', function() {
                var selectedOption = $('#list-addressTBin option[value="' + $(this).val() +
                    '"]');

                binIdInput.val(selectedOption.attr('data-tBinId'));
                tBinIdInput.val(selectedOption.attr('data-tBinId'));
                tAddressBinInput.val(selectedOption.attr('data-tBinAddress'));

            });
            //action jika valuenya=0
            triggerTBinInput.on('input', function() {
                if ($(this).val() === '') {
                    tBinIdInput.val('');
                    binIdInput.val('');
                    tAddressBinInput.val('');
                    binIdInput.val('');
                }
            });

            $('#addRowButton').click(function() {
                clearInputTBin();
                var newRow = '<tr>' +
                    '<td>' +
                    '<input type="text" class="inventoryId form-control input-border-bottom @error('inventory_id.*') is-invalid @enderror" name="inventory_id[]" list="list-invenId" required value="{{ old('inventory_id.*') }}">' +
                    '@error('inventory_id.*')' +
                    '<span class="invalid-feedback" role="alert">' +
                    '<strong>{{ $message }}</strong>' +
                    '</span>' +
                    '@enderror' +
                    '</td>' +
                    '<td>' +
                    '<input id="iPart" name="iPart[]" type="text"class="iPart form-control input-border-bottom " readonly required value="{{ old('iPart.*') }}">' +
                    ' @error('iPart.*')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror' +
                    '<input id="part_id" name="part_id[]" type="text" class="partId form-control input-border-bottom " required value = "{{ old('part_id.*') }}" hidden> ' +
                    '@error('part_id.*') <span class = "invalid-feedback" role = "alert" ><strong >{{ $message }} </strong></span> @enderror' +
                    '</td>' +
                    '<td>' +
                    '<input name="iDesc[]" type="text" class="iDesc form-control input-border-bottom " readonly required value="{{ old('iDesc.*') }}">' +
                    '@error('iDesc.*') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror' +
                    '<input name="bin_id[]" type="text" class = "binId form-control input-border-bottom " value = "{{ old('bin_id.*') }}" hidden>' +
                    ' @error('bin_id.*') <span class="invalid-feedback" role = "alert" ><strong >{{ $message }}</strong></span>@enderror' +
                    ' </td>' +
                    '<td>' +
                    '<input name="iUom[]" type="text" class="iUom form-control input-border-bottom " disabled value="{{ old('iUom.*') }}">' +
                    '@error('iUom.*')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror' +
                    '</td>' +
                    '<td>' +
                    '<input type="number" class="qty form-control input-border-bottom @error('qty.*') is-invalid @enderror" min="1" name="qty[]" value="{{ old('qty.*') }}">' +
                    '<input type="number" class="fakeQty form-control input-border-bottom" name="fakeQty[]" hidden required>' +
                    '@error('qty.*')' +
                    '<span class="invalid-feedback" role="alert">' +
                    '<strong>{{ $message }}</strong>' +
                    '</span>' +
                    '@enderror' +
                    '</td>' +
                    '<td>' +
                    '<input name="iLot[]" type="text" class="iLot form-control input-border-bottom " disabled value="{{ old('iLot.*') }}">' +
                    '@error('iLot.*') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror' +
                    '<input name="lot_id[]" type="lot_id text" class="lotId form-control input-border-bottom " required value = "{{ old('lot_id.*') }}" hidden> ' +
                    '@error('lot_id.*')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror' +
                    '</td>' +
                    '<td>' +
                    '<input name="iExpDate[]" type="date" class="iExpDate form-control input-border-bottom " disabled value="{{ old('iExpDate.*') }}">' +
                    '@error('iExpDate.*')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror' +
                    '</td>' +
                    '<td><button type="button" class="btn btn-danger removeRow"><span><i class="flaticon-interface-5"></i></span></button></td>' +
                    '</tr>';
                $('#parts_table tbody').append(newRow);
                // validateQty();


                var newRowElement = $('#parts_table tbody tr:last');
                newRowElement.find('.inventoryId').on('input', function() {
                    var inputVal = $(this).val();
                    var selectedOption = $('#list-invenId option[value="' + inputVal + '"]');

                    var duplicate = false;
                    $('.inventoryId').not($(this)).each(function() {
                        if ($(this).val() === inputVal) {
                            duplicate = true;
                            return false;
                        }
                    });

                    if (duplicate) {
                        this.setCustomValidity("This part desc already exist in another row!");
                    } else {
                        this.setCustomValidity("");
                    }


                    var dataDesc = selectedOption.attr('data-desc');
                    var dataPartId = selectedOption.attr('partId');
                    var dataLotId = selectedOption.attr('lotId');
                    var datakdPart = selectedOption.attr('data-kdParts');
                    var dataUom = selectedOption.attr('data-uom');
                    var dataQty = selectedOption.attr('data-qty');
                    var dataLot = selectedOption.attr('data-lot');
                    var dataExp = selectedOption.attr('data-exp');
                    newRowElement.find('.iPart').val(datakdPart);
                    newRowElement.find('.partId').val(dataPartId);
                    newRowElement.find('.lotId').val(dataLotId);
                    newRowElement.find('.iDesc').val(dataDesc);
                    newRowElement.find('.iUom').val(dataUom);
                    newRowElement.find('.qty').val(dataQty);
                    newRowElement.find('.fakeQty').val(dataQty);
                    newRowElement.find('.iLot').val(dataLot);
                    newRowElement.find('.iExpDate').val(dataExp);

                    validateQty(newRowElement.find('.qty'));
                    validateId(newRowElement.find('.inventoryId'));
                });

                // Remove row from table
                $("#parts_table").on('click', '.removeRow', function() {
                    $(this).closest('tr').remove();
                });

                var triggerFBinInputOnTable = $('#fakeFBin_id');
                var triggerTBinInputOnTable = $('#fakeTBin_id');
                var inventoryIdInputAddRow = $('.inventoryId');
                var iPartcInputAddRow = $('.iPart');
                var partIdInputAddRow = $('.partId');
                var lotIdInputAddRow = $('.lotId');
                var iDescInputAddRow = $('.iDesc');
                var iUomInputAddRow = $('.iUom');
                var qtyInputAddRow = $('.qty');
                var fakeQtyInputAddRow = $('.qty');
                var iLotInputAddRow = $('.iLot');
                var binIdInputAddRow = $('.binId');
                var iExpDateInputAddRow = $('.iExpDate');
                triggerFBinInputOnTable.on('input', function() {
                    if ($(this).val() === '') {
                        inventoryIdInputAddRow.val('');
                        iPartcInputAddRow.val('');
                        partIdInputAddRow.val('');
                        lotIdInputAddRow.val('');
                        iLotInputAddRow.val('');
                        iDescInputAddRow.val('');
                        qtyInputAddRow.val('');
                        fakeQtyInputAddRow.val('');
                        iUomInputAddRow.val('');
                        iLotInputAddRow.val('');
                        iExpDateInputAddRow.val('');
                        // console.log(inventoryIdInputAddRow);
                    }
                });
                triggerTBinInputOnTable.on('change', function() {
                    var selectedOption = $('#list-addressTBin option[value="' + $(this)
                        .val() +
                        '"]');
                    binIdInputAddRow.val(selectedOption.attr('data-tBinId'));
                });
                triggerTBinInputOnTable.on('input', function() {
                    var selectedOption = $('#list-addressTBin option[value="' + $(this)
                        .val() +
                        '"]');
                    if (selectedOption.length > 0) {
                        var dataDesc = selectedOption.attr('data-tBinId');
                        $(this).closest('tr').find('.binId').val(dataDesc);

                    }
                });

                function clearInputElemetTable() {
                    $('.inventoryId').val('');
                    $('.partId').val('');
                    $('.iPart').val('');
                    $('.lotId').val('');
                    $('.iDesc').val('');
                    $('.iUom').val('');
                    $('.qty').val('');
                    $('.fakeQty').val('');
                    $('.iLot').val('');
                    $('.iExpDate').val('');
                }
                triggerFBinInputOnTable.on('change', function() {
                    clearInputElemetTable();
                });
            });
        });
    </script>
@endsection
