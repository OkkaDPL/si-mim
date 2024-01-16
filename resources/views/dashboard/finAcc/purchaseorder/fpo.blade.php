@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/purchaseorders" method="POST">
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
                            <select class="form-control" name="status" id="status" hidden>
                                <option value="open" selected>Open</option>
                                <option value="close">Close</option>
                            </select>
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
                                                <select class="form-control @error('user_id') is-invalid @enderror"
                                                    for="principal_id" id="principal_id" name="principal_id" required>
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
                                                    class="form-control @error('tglExp') is-invalid @enderror" required
                                                    value="{{ old('tglExp') }}">
                                                @error('tglExp')
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
                                            @foreach (old('part_id', ['']) as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input class="form-control part-select" list="part_list"
                                                            id="part_id" name="part_id[]" required>
                                                        <datalist id="part_list">
                                                            @foreach ($parts as $part)
                                                                <option value="{{ $part->id }}"
                                                                    data-desc="{{ $part->nama }}"
                                                                    data-uom="{{ $part->uom->nama }}">
                                                            @endforeach
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input name="nama[]" type="text"
                                                            class="form-control input-border-bottom desc-input" disabled
                                                            value="{{ old('nama.' . $key) }}">
                                                        @error('nama.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input name="uomm[]" type="text"
                                                            class="form-control input-border-bottom uom-input" disabled
                                                            value="{{ old('uom.' . $key) }}">
                                                        @error('uom.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="hargasat" name="hargasat[]" type="text"
                                                            class="form-control input-border-bottom" required
                                                            value="{{ old('hargasat.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)">
                                                        @error('hargasat.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="qty" name="qty[]" type="text"
                                                            class="form-control input-border-bottom " required
                                                            value="{{ old('qty.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)">
                                                        @error('qty.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input name="hargatot[]" id="hargatot" type="text"
                                                            class="form-control input-border-bottom" required
                                                            value="{{ old('hargatot.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)">
                                                        @error('hargatot.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group form-floating-label">
                                <div class="col-md-3 float-right">
                                    <input id="amount" name="amount" type="text"
                                        class="form-control input-border-bottom @error('amount') is-invalid @enderror"
                                        required value="{{ old('amount') }}"
                                        onkeyup="formatNumber(this); calculateTotal()">
                                    <label for="amount" class="placeholder">Amount</label>
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-floating-label">
                                <div class="col-md-3 float-right">
                                    <input id="ppn" name="ppn" type="text"
                                        class="form-control input-border-bottom @error('ppn') is-invalid @enderror"
                                        required value="{{ old('ppn') }}"
                                        onkeyup="formatNumber(this); calculateTotal()">
                                    <label for="ppn" class="placeholder">PPN 11%</label>
                                    @error('ppn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-floating-label">
                                <div class="col-md-3 float-right">
                                    <input id="gtotal" name="gtotal" type="text"
                                        class="form-control input-border-bottom @error('gtotal') is-invalid @enderror"
                                        value="{{ old('gtotal') }}" onkeyup="formatNumber(this); calculateTotal()">
                                    <label for="gtotal" class="placeholder">Grand Total</label>
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
        // document.getElementById('submitBtn').addEventListener('click', function(event) {
        //     event.preventDefault(); // Mencegah pengiriman formulir secara otomatis

        //     var confirmation = confirm('Apakah Anda yakin ingin mengirim formulir?');

        //     if (confirmation) {
        //         // Lanjutkan pengiriman formulir
        //         document.getElementById('formId').submit();
        //     } else {
        //         // Batal pengiriman formulir
        //     }
        // });
        //autofill jika kd barang select
        function addAutofillListener(input) {
            input.addEventListener('input', function() {
                var selectedOption = getMatchingOption(input.value);
                if (selectedOption) {
                    var panggildesc = selectedOption.getAttribute('data-desc');
                    var panggiluom = selectedOption.getAttribute('data-uom');
                    var descElement = input.closest('tr').querySelector('.desc-input');
                    var uomElement = input.closest('tr').querySelector('.uom-input');
                    descElement.value = panggildesc;
                    uomElement.value = panggiluom;
                }
            });

            // Menjalankan pemilihan opsi terpilih saat form pertama kali dibuka
            var selectedOption = getMatchingOption(input.value);
            if (selectedOption) {
                var panggildesc = selectedOption.getAttribute('data-desc');
                var panggiluom = selectedOption.getAttribute('data-uom');
                var descElement = input.closest('tr').querySelector('.desc-input');
                var uomElement = input.closest('tr').querySelector('.uom-input');
                descElement.value = panggildesc;
                uomElement.value = panggiluom;
            }
        }

        function getMatchingOption(value) {
            var options = document.querySelectorAll('#part_list option');
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === value) {
                    return options[i];
                }
            }
            return null;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var partInputs = document.querySelectorAll('.part-select');
            partInputs.forEach(function(input) {
                addAutofillListener(input);
            });

            // Add new row to the table
            $(".addRow").click(function() {
                var html = '<tr>' +
                    '<td>' +
                    '<input class="form-control part-select" list="part_list" name="part_id[]" required>' +
                    '<datalist id="part_list">' +
                    '@foreach ($parts as $part)' +
                    '<option value="{{ $part->kd_parts }}" data-desc="{{ $part->nama }}" data-uom="{{ $part->uom->nama }}"></option>' +
                    '@endforeach' +
                    '</datalist>' +
                    '</td>' +
                    '<td><input name="nama[]" type="text" class="form-control input-border-bottom desc-input" disabled></td>' +
                    '<td><input name="uom[]" type="text" class="form-control input-border-bottom uom-input" disabled></td>' +
                    '<td><input name="hargasat[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('hargasat.' . $key) }}" required></td>' +
                    '<td><input name="qty[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('qty.' . $key) }}" required></td>' +
                    '<td><input name="hargatot[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('hargatot.' . $key) }}" required></td>' +
                    '<td><button type="button" class="btn btn-danger removeRow"><span><i class="flaticon-interface-5"></i></span></button></td>' +
                    '</tr>';
                $("#parts_table tbody").append(html);

                var newInput = document.querySelector('#parts_table tbody tr:last-child .part-select');
                addAutofillListener(newInput);
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
            var gtotalValue = amountValue + ppnValue;
            gtotalInput.value = gtotalValue.toLocaleString();
        }
    </script>
@endsection
