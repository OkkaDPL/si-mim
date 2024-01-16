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
                                                    <option value="">-- Pilih PO --</option>
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
                                            {{-- isi woy --}}
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#purchaseorder_id').on('change', function() {
            var po = $(this).val();
            if (po > 0) {
                $.ajax({
                    type: 'POST',
                    url: '/dashboard/goodreceipts/getitem',
                    data: {
                        'id': po
                    },
                    success: function(response) {
                        // $('#purchaseOrderItemsTbody').html(response);
                        console.log(response);
                    }
                });
            } else {
                $('#purchaseOrderItemsTbody').empty();
            }
        });
    </script>
@endsection
