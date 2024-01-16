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
                                            <th style="width: 35%">Stock On</th>
                                            <th style="width: 35%">Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select
                                                    class="form-control iniSelect2 @error('bin_id') is-invalid @enderror"
                                                    for="bin_id" id="bin_id" name="bin_id" required>
                                                    <option value="" selected>
                                                        Select Bin</option>
                                                    @foreach ($bin as $bin)
                                                        @if (old('bin_id') == $bin->id)
                                                            <option value="{{ $bin->id }}" selected>
                                                                {{ $bin->customer->nama }}</option>
                                                        @else
                                                            <option value="{{ $bin->id }}">{{ $bin->customer->nama }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control iniSelect2 @error('type') is-invalid @enderror"
                                                    for="type" id="type" name="type" required>
                                                    <option value="" selected>
                                                        Choose Type</option>
                                                    @if (old('type') == 'Adjust In')
                                                        (
                                                        <option value="Adjust In" selected>
                                                            Adjust In</option>
                                                        )
                                                    @else
                                                        (
                                                        <option value="Adjust In">
                                                            Adjust In</option>
                                                        <option value="Adjust Out">
                                                            Adjust Out</option>
                                                        )
                                                    @endif
                                                </select>
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
                                            <tr>
                                                <td>
                                                    <select name="part" id="part"
                                                        class="form-control @error('type') is-invalid @enderror" disabled>
                                                        <option value="" selected>Input desc first</option>
                                                        @foreach ($part as $i)
                                                            <option value="{{ $i->id }}">{{ $i->kd_parts }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" list="list-partNama"
                                                        class="partNama form-control input-border-bottom">
                                                    <datalist id="list-partNama">
                                                        <option>asdasdad</option>
                                                    </datalist>
                                                </td>
                                                <td>
                                                    <input type="text" class="uom form-control input-border-bottom"
                                                        disabled>
                                                </td>
                                                <td>
                                                    <input type="text" name="qty" id="qty"
                                                        class="form-control input-border-bottom" disabled>
                                                </td>
                                                <td>
                                                    <select name="idInventory" id="idInventory"
                                                        class="form-control @error('idInventory') is-invalid @enderror"
                                                        disabled>
                                                        <option value="" selected>LOT</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group form-floating-label col-md-6 float-right">
                                    <a class="b">Note</a>
                                    <textarea class="form-control @error('note') is-invalid @enderror" required id="note" name="note" type="text"
                                        rows="5">{{ old('note') }}</textarea>
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
            $('.iniSelect2').select2({
                width: '100%'
            });
            // var getBin = $('#bin_id').find('option:selected');
            var elBinId = $('#bin_id');
            var elUom = $('.uom');
            var elPart = $('#part');
            var elPartNama = $('.partNama');
            var elIdInven = $('#idInventory');
            elBinId.on('change', function() {
                var valBinId = $(this).val();
                $.ajax({
                    url: '/dashboard/adjuststock/triggedStockOn',
                    type: 'POST',
                    data: {
                        'getAllPart': valBinId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#list-partNama").html('');
                        $.each(result.dataPart, function(key, value) {
                            // console.log(value.uom.nama);
                            var partNama = value.nama;
                            var partId = value.id;
                            var partKdPart = value.kd_parts;
                            var partUom = value.uom.nama;
                            $("#list-partNama").append('<option value="' +
                                partNama +
                                '" data-partId="' + partId +
                                '" data-uom="' + partUom + '">' +
                                'Part : ' +
                                partKdPart +
                                '</option>');
                        });
                    }
                });
            })

            elPartNama.on('input', function() {
                var thisVal = $(this).val();
                var selectedOption = $('#list-partNama option[value="' + thisVal +
                    '"]');
                var getAttrPartId = selectedOption.attr('data-partId');
                var getAttrUom = selectedOption.attr('data-uom');
                elPart.val(getAttrPartId);
                elUom.val(getAttrUom);
                var test = elPart.val();
                $.ajax({
                    url: '/dashboard/adjuststock/getLot',
                    type: 'POST',
                    data: {
                        'getAllLot': test,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#idInventory').html('');
                        $.each(result.bgst, function(key, value) {
                            console.log(value.lot.kd_lots);
                        });
                    }
                });
            });
        });
    </script>
    {{-- <script>
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
    </script> --}}
@endsection
