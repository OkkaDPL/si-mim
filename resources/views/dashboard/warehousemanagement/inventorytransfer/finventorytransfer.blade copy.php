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
                                                    placeholder="Tolong input.." required>
                                                @error('fakeFBin_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <datalist id="list-addressFBin">
                                                    <option value="" selected></option>
                                                    @foreach ($bins as $bin)
                                                        @if (old('fakeFBin_id') == $bin->id_bins)
                                                            <option value="{{ $bin->id_bins }}"
                                                                data-fBinId="{{ $bin->id }}"
                                                                data-fBinAddress="{{ $bin->alamat }}" selected>
                                                                {{ $bin->id_bins }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $bin->id_bins }}"
                                                                data-fBinId="{{ $bin->id }}"
                                                                data-fBinAddress="{{ $bin->alamat }}">
                                                                {{ $bin->id_bins }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </datalist>

                                                <input type="text" name="fromBin_id" id="fromBin_id"
                                                    value="{{ old('fromBin_id') }}" required>
                                            </td>
                                            <td>
                                                <input type="text" name="fakeTBin_id" id="fakeTBin_id"
                                                    class="triggerTBin form-control input-border-bottom @error('fakeTBin_id') is-invalid @enderror"
                                                    list="list-addressTBin" value="{{ old('fakeTBin_id') }}"
                                                    placeholder="Tolong input.." required>
                                                @error('fakeTBin_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <datalist id="list-addressTBin">
                                                    <option value="" selected></option>
                                                    @foreach ($bins as $bin)
                                                        @if (old('fakeTBin_id') == $bin->id_bins)
                                                            <option value="{{ $bin->id_bins }}"
                                                                data-tBinId="{{ $bin->id }}"
                                                                data-tBinAddress="{{ $bin->alamat }}" selected>
                                                                {{ $bin->id_bins }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $bin->id_bins }}"
                                                                data-tBinId="{{ $bin->id }}"
                                                                data-tBinAddress="{{ $bin->alamat }}">
                                                                {{ $bin->id_bins }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </datalist>

                                                <input type="text" name="toBin_id" id="toBin_id"
                                                    value="{{ old('toBin_id') }}" required>
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
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="fAddressBin" id="fAddressBin" cols="40" rows="5" class="input-addressFBin" readonly></textarea>
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
                                                <th>LOT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (old('iDaListPart', ['']) as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="iDaListPart[]" id="iDaListPart"
                                                            class="form-control input-border-bottom @error('iDaListPart.' . $key) is-invalid @enderror"
                                                            list="list-invenId" value="{{ old('iDaListPart.' . $key) }}"
                                                            required>
                                                        @error('iDaListPart.' . $key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <datalist id="list-invenId">
                                                            {{-- <option value="" selected></option>
                                                            @foreach ($inventory as $inventory)
                                                                <option value="{{ $inventory->part->kd_parts }}"
                                                                    data-part="{{ $inventory->id }}"
                                                                    data-desc="{{ $inventory->part->nama }}"
                                                                    data-uom="{{ $inventory->part->uom->nama }}"
                                                                    data-qty="{{ $inventory->qty }}"
                                                                    data-exp="{{ $inventory->lot->exp }}"
                                                                    data-lot="{{ $inventory->lot->kd_lots }}">
                                                                    {{ 'Desc : ' }} {{ $inventory->part->nama }}
                                                                    {{ 'LOT : ' }} {{ $inventory->lot->kd_lots }}
                                                                </option>
                                                            @endforeach --}}
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input id="iLot" name="iLot[]" type="text"
                                                            class="form-control input-border-bottom " disabled
                                                            value="{{ old('iLot.' . $key) }}"
                                                            onkeyup="formatNumber(this); calculateTotal(this)">
                                                        @error('iLot.' . $key)
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
            //autofill input address & hidden formBin_id

            //mendapatkan setiap form yang ingin dipakai
            var triggerFBinInput = document.getElementById('fakeFBin_id');
            var fBinIdInput = document.getElementById('fromBin_id');
            var fAddressBinInput = document.getElementById('fAddressBin');
            //action jika terjadi perubahan
            triggerFBinInput.addEventListener('change', function() {
                var selectedOption = document.querySelector('#list-addressFBin option[value="' + this
                    .value + '"]');

                fBinIdInput.value = selectedOption.getAttribute('data-fBinId');
                fAddressBinInput.value = selectedOption.getAttribute('data-fBinAddress');

            });
            //action jika valuenya = 0
            triggerFBinInput.addEventListener('input', function() {
                if (this.value === '') {
                    fBinIdInput.value = '';
                    fAddressBinInput.value = '';
                }
            });

            //autofill input address & hidden toBinid

            //mendapatkan setiap form yang ingin dipakai
            var triggerTBinInput = document.getElementById('fakeTBin_id');
            var tBinIdInput = document.getElementById('toBin_id');
            var tAddressBinInput = document.getElementById('tAddressBin');
            //action perubahan
            triggerTBinInput.addEventListener('change', function() {
                var selectedOption = document.querySelector('#list-addressTBin option[value="' + this
                    .value + '"]');

                tBinIdInput.value = selectedOption.getAttribute('data-tBinId');
                tAddressBinInput.value = selectedOption.getAttribute('data-tBinAddress');
            });
            //action jika valuenya=0
            triggerTBinInput.addEventListener('input', function() {
                if (this.value === '') {
                    tBinIdInput.value = '';
                    tAddressBinInput.value = '';
                }
            });

            //autofill untuk data item/part
            $(document).ready(function() {
                // Fungsi untuk mengosongkan nilai input #iDaListPart dan #iLot
                function clearInputValue() {
                    $('#iDaListPart').val('');
                    $('#iLot').val('');
                }

                $('#fakeFBin_id').on('change', function() {
                    var selectedOption = $('#list-addressFBin option[value="' + $(this).val() +
                        '"]');
                    var fBinId = selectedOption.data('fbinid');

                    console.log(fBinId);

                    // Mengosongkan nilai input #iDaListPart dan #iLot saat bin berubah
                    clearInputValue();

                    $("#list-invenId").html('');
                    $.ajax({
                        url: '/dashboard/inventorytransfer/triggedBin',
                        type: "POST",
                        data: {
                            get_bin: getElementBin,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $("#list-invenId").html('');
                            $.each(result.inventoryTriggedBin, function(key, value) {
                                var invenPartId = value.part_id;
                                var invenId = value.id;
                                var partInven_nama = value.part.nama;
                                var partInven_lot = value.lot.kd_lots;
                                $("#list-invenId").append('<option value="' +
                                    invenId +
                                    '" data-part="' + invenPartId +
                                    '" data-lot="' +
                                    partInven_lot + '">' + 'Part : ' +
                                    partInven_nama +
                                    ',   LOT : ' + partInven_nama +
                                    '</option>');
                            });
                        }
                    });
                });

                $('#iDaListPart').on('change', function() {
                    var inputVal = $(this).val();
                    var selectedOption = $('#list-invenId option[value="' + inputVal + '"]');

                    if (selectedOption.length > 0) {
                        var dataLot = selectedOption.attr('data-lot');
                        $('#iLot').val(dataLot);
                    } else {
                        // Jika tidak ada opsi yang cocok, mengosongkan nilai input iLot
                        $('#iLot').val('');
                    }
                });
            });

        });


        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        // $('#fromBin_id').on('change', function() {
        //     var bin = $(this).val('');
        //     if (bin > 0) {
        //         $.ajax({
        //             type: 'POST',
        //             url: '/dashboard/inventorytransfer',
        //             data: {
        //                 'id': bin
        //             }
        //         });
        //     }
        //     console.log(bin);
        // });
    </script>
    {{-- <script>
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
        function addAutofillListener(select) {
            select.addEventListener('change', function() {
                var selectedOption = select.options[select.selectedIndex];
                var panggildesc = selectedOption.getAttribute('data-desc');
                var panggiluom = selectedOption.getAttribute('data-uom');
                var descElement = select.closest('tr').querySelector('.desc-input');
                var uomElement = select.closest('tr').querySelector('.uom-input');
                descElement.value = panggildesc;
                uomElement.value = panggiluom;
                console.log(panggildesc);
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
                    '<td><input name="hargasat[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('hargasat.' . $key) }}"required></td>' +
                    '<td><input name="qty[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('qty.' . $key) }}"required></td>' +
                    '<td><input name="hargatot[]" type="text" class="form-control input-border-bottom" onkeyup="formatNumber(this); calculateTotal(this)" value="{{ old('hargatot.' . $key) }}"required></td>' +
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
    </script> --}}
@endsection
