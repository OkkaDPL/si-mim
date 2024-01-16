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
                                                <select class="form-control" for="purchaseorder_id" id="purchaseorder_id"
                                                    name="purchaseorder_id" required>
                                                    <option value="">-- Pilih PO --</option>
                                                    @foreach ($purchaseorder as $purchaseorder)
                                                        @if (old('purchaseorder_id') == $purchaseorder->id)
                                                            <option value="{{ $purchaseorder->id }}"
                                                                kocak-principal="{{ $purchaseorder->principal->nama }}"
                                                                selected>
                                                                {{ $purchaseorder->id_purchaseorder }}</option>
                                                        @else
                                                            <option value="{{ $purchaseorder->id }}"
                                                                kocak-principal="{{ $purchaseorder->principal->nama }}">
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
                                        <tr>
                                            <td>
                                                <a class="b">
                                                    Delivery Order
                                                </a>
                                            </td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="suratjalan" id="suratjalan"
                                                    class="form-control suratjalan-input" value="{{ old('suratjalan') }}"
                                                    required>
                                                @error('suratjalan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>

                                            </td>
                                            <td>

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
                                                <th style="width: 8%">UOM</th>
                                                <th style="width: 8%">Qty</th>
                                                <th>LOT</th>
                                                <th>Exp Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="purchaseOrderItemsTbody">
                                            {{-- isi woy --}}
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
                                    onclick="return confirm('Are you sure to submit the form?')">Submit</button>
                                <a href="/dashboard/purchaseorders" class="btn btn-danger">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        //select2
        $(document).ready(function() {
            $('#purchaseorder_id').select2({
                width: '100%'
            });
            var purchaseorderSelect = $('#purchaseorder_id');
            var principalInput = $('#principal');

            // Menambahkan event listener untuk perubahan pada select
            purchaseorderSelect.on('change', function() {
                var selectedOption = purchaseorderSelect.find(':selected');
                var principalValue = selectedOption.attr('kocak-principal');

                principalInput.val(principalValue);
            });
        });

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
                        'kocak': po
                    },
                    success: function(response) {
                        $('#purchaseOrderItemsTbody').html(response);
                        $('.lotSelect').select2({
                            width: '100%'
                        });
                        var elQty = $('.iQty');
                        var elLot = $('.lotSelect');
                        elQty.each(function() {
                            thisValQty = $(this).val();
                            var elLotClosest = $(this).closest('tr').find('.lotSelect');
                            // console.log(lotSelectCariQty);
                            if (thisValQty > 0) {
                                elLotClosest.prop('required', true);
                            }
                        });
                        elQty.on('input', function() {
                            var thisValQty = $(this).val();
                            // console.log(thisValQty);
                            var elLotClosest = $(this).closest('tr').find('.lotSelect');
                            // console.log(elLotClosest);
                            if (thisValQty > 0) {
                                elLotClosest.prop('required', true);
                            } else {
                                elLotClosest.prop('required', false);
                            }
                        });
                        elLot.on('change', function() {
                            var thisEl = $(this);
                            var selectedOption = thisEl.find('option:selected');
                            var getAttrLotDesc = selectedOption.data('exp');
                            var elExpClosest = $(this).closest('tr').find('.iExp');
                            elExpClosest.val(getAttrLotDesc)
                            // console.log(getAttrLotDesc);

                        });
                    }
                });

            } else {
                $('#purchaseOrderItemsTbody').empty();
            }
        });
    </script>
@endsection
