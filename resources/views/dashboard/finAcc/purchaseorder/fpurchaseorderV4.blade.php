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
                                                <select class="form-control @error('principal_id') is-invalid @enderror"
                                                    for="principal_id" id="principal_id" name="principal_id" required>
                                                    @foreach ($principals as $principal)
                                                        <option value="" selected>
                                                            Choose Principal</option>
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
                                            <td>
                                                <select class="form-control" name="part_id[]" id="part_id" readonly>
                                                    <option value="" selected>
                                                    </option>
                                                    @foreach ($parts as $part)
                                                        <option value="{{ $part->id }}">
                                                            {{ $part->kd_parts }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="nama[]"
                                                    id="nama"class="form-control input-border-bottom" list="list-nama">
                                                <datalist id="list-nama">
                                                    <option value=""selected>

                                                    </option>
                                                    @foreach ($parts as $part)
                                                        <option value="{{ $part->nama }}"
                                                            data-part="{{ $part->id }}"
                                                            data-uom="{{ $part->uom->nama }}">
                                                            {{ $part->kd_parts }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="text" name="uom[]"
                                                    class="form-control input-border-bottom"
                                                    value="{{ old('uom') }}"disabled>
                                            </td>
                                            <td>
                                                <input id="hargasat" name="hargasat" type="text"
                                                    class="form-control input-border-bottom" required
                                                    value="{{ old('hargasat') }}">

                                            </td>
                                            <td>
                                                <input id="qty" name="qty" type="text"
                                                    class="form-control input-border-bottom " required
                                                    value="{{ old('qty') }}">

                                            </td>
                                            <td>
                                                <input name="hargatot" id="hargatot" type="text"
                                                    class="form-control input-border-bottom" required
                                                    value="{{ old('hargatot') }}">
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group
                                                    form-floating-label">
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
                                        class="form-control input-border-bottom @error('ppn') is-invalid @enderror" required
                                        value="{{ old('ppn') }}" onkeyup="formatNumber(this); calculateTotal()">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Mendaftarkan listener untuk setiap input nama
            var namaInputs = document.querySelectorAll('input[name="nama[]"]');
            namaInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    var selectedOption = document.querySelector('#list-nama option[value="' + this
                        .value + '"]');
                    var partSelect = this.closest('tr').querySelector('select[name="part_id[]"]');
                    var uomInput = this.closest('tr').querySelector('input[name="uom[]"]');

                    if (selectedOption) {
                        partSelect.value = selectedOption.getAttribute('data-part');
                        uomInput.value = selectedOption.getAttribute('data-uom');
                    } else {
                        partSelect.value = '';
                        uomInput.value = '';
                    }
                });
            });
        });
    </script>
@endsection
