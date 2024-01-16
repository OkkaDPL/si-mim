@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/goodreceipts" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">{{ $title }}</h4>
                                </div>
                            </div>
                            {{-- ini bagian header --}}
                            <div class="table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>PO Number</th>
                                            <th>Principal</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control purchaseorder-select" for="purchaseorder_id"
                                                    id="purchaseorder_id" name="purchaseorder_id" required>
                                                    @foreach ($purchaseorder as $purchaseorder)
                                                        @if (old('purchaseorder_id') == $purchaseorder->id)
                                                            <option value="{{ $purchaseorder->id }}"
                                                                data-principal="{{ $purchaseorder->principal->nama }}"
                                                                data-part="{{ $purchaseorder->purchaseOrderItem }}"
                                                                selected>
                                                                {{ $purchaseorder->id_purchaseorder }}</option>
                                                        @else
                                                            <option value="{{ $purchaseorder->id }}"
                                                                data-principal="{{ $purchaseorder->principal->nama }}"
                                                                data-part="{{ $purchaseorder->purchaseOrderItem }}">
                                                                {{ $purchaseorder->id_purchaseorder }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="principal" id="principal"
                                                    class="form-control principal-input" disabled
                                                    value="{{ old('principal') }}">
                                                @error('principal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                            <td>
                                                <input type="date" name="tanggal" id="tanggal"
                                                    class="form-control @error('tanggal') is-invalid @enderror" required
                                                    value="{{ old('tanggal') }}"">
                                                @error('tanggal')
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
                                                <th>Qty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="purchaseOrderItemsTbody">
                                            @foreach ($purchaseorder->purchaseOrderItem as $key => $item)
                                                {{ $item }}
                                                <tr>
                                                    <td>
                                                        <select class="form-control part-select" id="part_id"
                                                            name="part_id[]" required>
                                                            @foreach ($parts as $part)
                                                                <option value="{{ $part->id }}"
                                                                    data-desc="{{ $part->nama }}"
                                                                    data-uom="{{ $part->uom->nama }}"
                                                                    {{ old('part_id.' . $key, $item->part_id) == $part->id ? 'selected' : '' }}>
                                                                    {{ $part->kd_parts }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input name="nama[]" type="text"
                                                            class="form-control input-border-bottom desc-input" disabled
                                                            value="{{ old('nama.' . $key, $item->part->nama) }}">
                                                        @error('nama.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input name="uomm[]" type="text"
                                                            class="form-control input-border-bottom uom-input" disabled
                                                            value="{{ old('uom.' . $key, $item->part->uom->nama) }}">
                                                        @error('uom.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="qty" name="qty[]" type="text"
                                                            class="form-control input-border-bottom " required
                                                            value="{{ number_format(old('qty.' . $key, $item->qty), 0, '.', ',') }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)">
                                                        @error('qty.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <input id="warehouse_id" name="warehouse_id[]" type="text"
                                                            class="form-control input-border-bottom " hidden
                                                            value="{{ '1' }}">
                                                        @error('warehouse_id.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select class="form-control lot-select" id="lot_id"
                                                            name="lot_id[]" required>
                                                            @foreach ($lots as $lot)
                                                                <option value="{{ $lot->id }}"
                                                                    data-exp="{{ $lot->exp }}"
                                                                    {{ old('lot_id.' . $key, $lot->id) == $lot->id ? 'selected' : '' }}>
                                                                    {{ $lot->kd_lots }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
        document.addEventListener('DOMContentLoaded', function() {

            var purchaseorderSelect = document.getElementById('purchaseorder_id');
            var principalInput = document.getElementById('principal');

            // Mendapatkan data-principal dari opsi yang dipilih saat form pertama kali dibuka
            var selectedOption = purchaseorderSelect.options[purchaseorderSelect.selectedIndex];
            var principalValue = selectedOption.getAttribute('data-principal');

            // Mengisi nilai input principal dengan data-principal yang terpilih
            principalInput.value = principalValue;

            // Menambahkan event listener untuk perubahan pada select
            purchaseorderSelect.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var principalValue = selectedOption.getAttribute('data-principal');

                principalInput.value = principalValue;

                // Menambahkan console.log() untuk mencetak nilai principalValue ke konsol
                // console.log(principalValue);
            });
        });
    </script>
@endsection
