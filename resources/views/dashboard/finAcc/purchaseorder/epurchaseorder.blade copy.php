@extends('dashboard.layouts.main')

@section('isibody')
<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form action="/dashboard/purchaseorders/{{ $purchaseorder->id }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $title }}: {{ $purchaseorder->id_purchaseorder }}</h4>
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
                                            <select class="form-control @error('user_id') is-invalid @enderror" for="principal_id" id="principal_id" name="principal_id" required>
                                                @foreach ($principals as $principal)
                                                @if (old('principal_id', $purchaseorder->principal->id) == $principal->id)
                                                <option value="{{ $purchaseorder->principal->id }}" selected>
                                                    {{ $purchaseorder->principal->nama }}
                                                </option>
                                                @else
                                                <option value="{{ $principal->id }}">{{ $principal->nama }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="tglCreate" id="tglCreate" class="form-control @error('tglCreate') is-invalid @enderror" required value="{{ old('tglCreate', $purchaseorder->tglCreate) }}">
                                            @error('tglCreate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="date" name="tglExp" id="tglExp" class="form-control @error('tglExp') is-invalid @enderror" required value="{{ old('tglExp', $purchaseorder->tglExp) }}">
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
                                        @foreach ($purchaseorder->purchaseOrderItem as $key => $item)
                                        <tr>
                                            <td>
                                                <select class="form-control part-select" id="part_id" name="part_id[]" required>
                                                    @foreach ($parts as $part)
                                                    <option value="{{ $part->id }}" data-desc="{{ $part->nama }}" data-uom="{{ $part->uom->nama }}" {{ old('part_id.' . $key, $item->part_id) == $part->id ? 'selected' : '' }}>
                                                        {{ $part->kd_parts }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input name="nama[]" type="text" class="form-control input-border-bottom desc-input" disabled value="{{ old('nama.' . $key) }}">
                                                @error('nama.' . $key)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input name="uomm[]" type="text" class="form-control input-border-bottom uom-input" disabled value="{{ old('uom.' . $key) }}">
                                                @error('uom.' . $key)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input id="hargasat" name="hargasat[]" type="text" class="form-control input-border-bottom" required value="{{ number_format(old('hargasat.' . $key, $item->hargasat), 0, '.', ',') }}" onkeyup="formatNumber(this); calculateTotal(this)">
                                                @error('hargasat.' . $key)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input id="qty" name="qty[]" type="text" class="form-control input-border-bottom " required value="{{ number_format(old('qty.' . $key, $item->qty), 0, '.', ',') }}" onkeyup="formatNumber(this); calculateTotal(this)">
                                                @error('qty.' . $key)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input name="hargatot[]" id="hargatot" type="text" class="form-control input-border-bottom" required value="{{ number_format(old('hargatot.' . $key, $item->hargatot), 0, '.', ',') }}" onkeyup="formatNumber(this); calculateTotal(this)">
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
                                <input id="amount" name="amount" type="text" class="form-control input-border-bottom @error('amount') is-invalid @enderror" required value="{{ number_format(old('amount', $purchaseorder->amount), 0, '.', ',') }}" onkeyup="formatNumber(this); calculateTotal()">
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
                                <input id="ppn" name="ppn" type="text" class="form-control input-border-bottom @error('ppn') is-invalid @enderror" required value="{{ number_format(old('ppn', $purchaseorder->ppn), 0, '.', ',') }}" onkeyup="formatNumber(this); calculateTotal()">
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
                                <input id="gtotal" name="gtotal" type="text" class="form-control input-border-bottom @error('gtotal') is-invalid @enderror" value="{{ number_format(old('gtotal', $purchaseorder->gtotal), 0, '.', ',') }}" onkeyup="formatNumber(this); calculateTotal()">
                                <label for="gtotal" class="placeholder">Grand Total</label>
                                @error('gtotal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="/dashboard/purchaseorders" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function formatNumber(input) {
        // Menghapus koma dari nilai input sebelum memformat angka
        var value = input.value.replace(/,/g, '');

        // Memformat angka dengan menambahkan koma setiap 3 digit
        value = parseFloat(value).toLocaleString();

        // Memasukkan kembali nilai yang telah diformat ke input
        input.value = value;
    }

    function addAutofillListener(select) {
        select.addEventListener('change', function() {
            var selectedOption = select.options[select.selectedIndex];
            var panggildesc = selectedOption.getAttribute('data-desc');
            var panggiluom = selectedOption.getAttribute('data-uom');
            var descElement = select.closest('tr').querySelector('.desc-input');
            var uomElement = select.closest('tr').querySelector('.uom-input');
            descElement.value = panggildesc;
            uomElement.value = panggiluom;
        });

        // Menjalankan pemilihan opsi terpilih saat form pertama kali dibuka
        var selectedOption = select.options[select.selectedIndex];
        var panggildesc = selectedOption.getAttribute('data-desc');
        var panggiluom = selectedOption.getAttribute('data-uom');
        var descElement = select.closest('tr').querySelector('.desc-input');
        var uomElement = select.closest('tr').querySelector('.uom-input');
        descElement.value = panggildesc;
        uomElement.value = panggiluom;
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
        var gtotalValue = total + ppnValue;
        gtotalInput.value = gtotalValue.toLocaleString();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var partSelects = document.querySelectorAll('.part-select');
        partSelects.forEach(function(select) {
            addAutofillListener(select);
        });

        // Add new row to the table
        $(".addRow").click(function() {
            var html = '<tr>' +
                '<td>' +
                '<select class="form-control part-select" name="part_id[]" required>' +
                '@foreach ($parts as $part)' +
                '<option value="{{ $part->id }}" data-desc="{{ $part->nama }}" data-uom="{{ $part->uom->nama }}">{{ $part->kd_parts }}</option>' +
                '@endforeach' +
                '</select>' +
                '</td>' +
                '<td><input name="nama[]" type="text" class="form-control input-border-bottom desc-input" disabled></td>' +
                '<td><input name="uom[]" type="text" class="form-control input-border-bottom uom-input" disabled></td>' +
                '<td><input name="hargasat[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('
            hargasat.
            ' . $key) }}"required></td>' +
            '<td><input name="qty[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('
            qty.
            ' . $key) }}"required></td>' +
            '<td><input name="hargatot[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('
            hargatot.
            ' . $key) }}"required></td>' +
            '<td><button type="button" class="btn btn-danger removeRow"><span><i class="flaticon-interface-5"></i></span></button></td>' +
            '</tr>';
            $("#parts_table tbody").append(html);

            var newSelect = document.querySelector('#parts_table tbody tr:last-child .part-select');
            addAutofillListener(newSelect);
        });
        // Remove row from table
        $("#parts_table").on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection