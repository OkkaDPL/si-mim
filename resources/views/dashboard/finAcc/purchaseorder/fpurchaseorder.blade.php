@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/purchaseorders" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">{{ $title }}</h4>
                                    <button class="btn btn-primary btn-round ml-auto addRow">
                                        <span><i class="fa fa-plus"></i></span> Add Row
                                    </button>
                                </div>
                            </div>
                            {{-- ini bagian header --}}
                            <div class="table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Principals</th>
                                            <th>Date</th>
                                            <th>Expired Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select
                                                    class="form-control iniSelect2 @error('principal_id') is-invalid @enderror"
                                                    for="principal_id" id="principal_id" name="principal_id" required>
                                                    <option value="" selected>
                                                        Select Principals</option>
                                                    @foreach ($principals as $principal)
                                                        @if (old('principal_id') == $principal->id)
                                                            <option value="{{ $principal->id }}" selected>
                                                                {{ $principal->nama }}</option>
                                                        @else
                                                            <option value="{{ $principal->id }}">{{ $principal->nama }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="date" name="tglCreate" id="tglCreate"
                                                    class="form-control @error('tglCreate') is-invalid @enderror" required
                                                    value="{{ old('tglCreate') }}">
                                                @error('tglCreate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="date" name="tglExp" id="tglExp"
                                                    min="{{ old('tglCreate') }}"
                                                    class="form-control @error('tglExp') is-invalid @enderror" required
                                                    value="{{ old('tglExp') }}">
                                                @error('tglExp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><a class="b">Price list</a> *file type must PDF</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <input type="file" name="pricelist" id="pricelist"
                                                    class="form-control-file @error('pricelist') is-invalid @enderror"
                                                    id="pricelist" required>
                                                @error('pricelist')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
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
                                                <th style="width: 30%">Part Desc</th>
                                                <th>UOM</th>
                                                <th>Unit Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (old('fake_part_id', ['']) as $key => $value)
                                                <a>{{ $value }}</a>
                                                <tr>
                                                    <td>
                                                        <select
                                                            class="hapusValue form-control @error('fake_part_id.' . $key) is-invalid @enderror"
                                                            name="fake_part_id[]" id="fake_part_id" class="hapusValue"
                                                            disabled>
                                                            <option value="" selected>
                                                            </option>
                                                            @foreach ($parts as $part)
                                                                @if (old('part_id.' . $key) == $part->id)
                                                                    <option value="{{ $part->id }}" selected>
                                                                        {{ $part->kd_parts }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $part->id }}">
                                                                        {{ $part->kd_parts }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="text" name="part_id[]"
                                                            class="hapusValue @error('part_id.' . $key) is-invalid @enderror"
                                                            id="part_id"value="{{ old('part_id.' . $key) }}" required
                                                            hidden>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nama[]" id="nama"
                                                            class="partNama form-control input-border-bottom @error('nama.' . $key) is-invalid @enderror"
                                                            list="list-nama" value="{{ old('nama.' . $key) }}" required>
                                                        @error('nama.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <datalist id="list-nama">
                                                            <option value="" selected></option>
                                                            @foreach ($parts as $part)
                                                                @if (old('nama.' . $key) == $part->nama)
                                                                    <option value="{{ $part->nama }}"
                                                                        data-part="{{ $part->id }}"
                                                                        data-uom="{{ $part->uom->nama }}"selected>
                                                                        {{ $part->kd_parts }}</option>
                                                                @else
                                                                    <option value="{{ $part->nama }}"
                                                                        data-part="{{ $part->id }}"
                                                                        data-uom="{{ $part->uom->nama }}">
                                                                        {{ $part->kd_parts }}</option>
                                                                @endif
                                                            @endforeach
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input name="uom[]" id=uom type="text"
                                                            class="hapusValue form-control input-border-bottom @error('uom.' . $key) is-invalid @enderror"
                                                            readonly value="{{ old('uom.' . $key) }}">
                                                        @error('uom.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="hargasat" name="hargasat[]" type="text"
                                                            class="hapusValue form-control input-border-bottom @error('hargasat.' . $key) is-invalid @enderror"
                                                            required value="{{ old('hargasat.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)">
                                                        @error('hargasat.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="qty" name="qty[]" type="text"
                                                            class="hapusValue qty form-control input-border-bottom @error('qty.' . $key) is-invalid @enderror"
                                                            required value="{{ old('qty.' . $key) }}" pattern="[0-9]{1,5}"
                                                            onkeyup="calculateTotal(this)">
                                                        @error('qty.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input name="hargatot[]" id="hargatot" type="text"
                                                            class="hapusValue form-control input-border-bottom @error('hargatot.' . $key) is-invalid @enderror"
                                                            required readonly value="{{ old('hargatot.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)">
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
                                        class="form-control input-border-bottom @error('amount') is-invalid @enderror"
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
                                        class="form-control input-border-bottom @error('ppn') is-invalid @enderror"
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
                                        class="form-control input-border-bottom @error('gtotal') is-invalid @enderror"
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
        document.addEventListener('DOMContentLoaded', function() {
            $('.iniSelect2').select2();
            var tglCreateInput = $('#tglCreate');
            var tglExpInput = $('#tglExp');
            var kuantiti = $('.qty')

            tglCreateInput.on('change', function() {
                tglExpInput.val('');
                tglExpInput.attr('min', tglCreateInput.val());
            });

            // kuantiti.each(function() {
            //     var kocz = $(this);

            //     kocz.on('input', function() {
            //         console.log('wkwkwk');
            //     });
            // });

            $('.partNama').each(function() {
                $(this).on('input', function() {
                    var iniDia = $(this);
                    var selectedOption = $('#list-nama option[value="' + $(this).val() + '"]');
                    var fakePartSelect = $(this).closest('tr').find(
                        'select[name="fake_part_id[]"]');
                    var uomInput = $(this).closest('tr').find('input[name="uom[]"]');
                    var partInput = $(this).closest('tr').find('input[name="part_id[]"]');

                    fakePartSelect.val(selectedOption.attr('data-part'));
                    uomInput.val(selectedOption.attr('data-uom'));
                    partInput.val(selectedOption.attr('data-part'));

                    var kocak = $(this).val().trim();
                    var duplicate = false;
                    var dataListOption = $('#list-nama').find("option");
                    var isValid = false;
                    dataListOption.each(function() {
                        if ($(this).val() === kocak) {
                            isValid = true;
                            return false;
                        }
                    });
                    if (!isValid) {
                        console.log('memec');
                    }

                    $('.partNama').not($(this)).each(function() {
                        if ($(this).val() === kocak) {
                            duplicate = true;
                            return false;
                        }
                    });

                    // console.log(duplicate);
                    if (duplicate) {
                        this.setCustomValidity("This part desc already exist in another row!");
                    } else {
                        this.setCustomValidity("");
                    }
                });
            });

            // Add new row to the table
            $(".addRow").click(function() {
                var html = '<tr>' +
                    '<td>' +
                    '<select class="hapusValue form-control" name="fake_part_id[]" id="fake_part_id" disabled> <option value="" selected> </option> @foreach ($parts as $part) @if (old('fake_part_id.' . $key) == $part->id) <option value="{{ $part->id }}" selected> {{ $part->kd_parts }} </option> @else <option value="{{ $part->id }}"> {{ $part->kd_parts }} </option> @endif @endforeach </select> <input type="text" class="hapusValue" name="part_id[]" id="part_id"value="{{ old('part_id.' . $key) }}" hidden>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="nama[]" id="nama" class="partNama form-control input-border-bottom @error('nama.' . $key) is-invalid @enderror" list="list-nama" value="{{ old('nama.' . $key) }}" required> @error('nama.' . $key) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror <datalist id="list-nama"> <option value="" selected></option> @foreach ($parts as $part) <option value="{{ $part->nama }}" data-part="{{ $part->id }}" data-uom="{{ $part->uom->nama }}"> {{ $part->kd_parts }}</option> @endforeach </datalist>' +
                    '</td>' +
                    '<td><input name="uom[]" id="uom" type="text" class="hapusValue form-control input-border-bottom uom-input" value="{{ old('uom.' . $key) }}" disabled></td>' +
                    '<td><input name="hargasat[]" id="hargasat" type="text" class="hapusValue form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('hargasat.' . $key) }}"required></td>' +
                    '<td><input name="qty[]" id="qty" type="text" class="hapusValue qty form-control input-border-bottom" onkeyup="calculateTotal(this)" pattern="[0-9]{1,5}" value="{{ old('qty.' . $key) }}"required></td>' +
                    '<td><input name="hargatot[]" id="hargatot" type="text" class="hapusValue form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('hargatot.' . $key) }}"required readonly></td>' +
                    '<td><button type="button" class="btn btn-danger removeRow"><span><i class="flaticon-interface-5"></i></span></button></td>' +
                    '</tr>';
                $("#parts_table tbody").append(html);

                var newInput = $('#parts_table tbody tr:last-child .partNama');
                newInput.on('input', function() {
                    var selectedOption = $('#list-nama option[value="' + $(this).val() + '"]');
                    var fakePartSelect = $(this).closest('tr').find(
                        'select[name="fake_part_id[]"]');
                    var uomInput = $(this).closest('tr').find('input[name="uom[]"]');
                    var partInput = $(this).closest('tr').find('input[name="part_id[]"]');

                    fakePartSelect.val(selectedOption.attr('data-part'));
                    uomInput.val(selectedOption.attr('data-uom'));
                    partInput.val(selectedOption.attr('data-part'));

                    var kocak = $(this).val();
                    var duplicate = false;
                    $('.partNama').not($(this)).each(function() {
                        if ($(this).val() === kocak) {
                            duplicate = true;
                            return false;
                        }
                    });

                    if (duplicate) {
                        this.setCustomValidity("This part desc already exist in another row!");
                    } else {
                        this.setCustomValidity("");
                    }
                });
            });

            // Remove row from table
            $("#parts_table").on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });
        });

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
