@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/test" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <select class="form-control @error('ini_bin') is-invalid @enderror" for="ini_bin"
                                        id="ini_bin" name="ini_bin" required>
                                        <option value="">Choose BIN</option>
                                        @foreach ($bin as $bin)
                                            @if (old('ini_bin') == $bin->id)
                                                <option value="{{ $bin->id }}">
                                                    {{ $bin->id_bins }}</option>
                                            @else
                                                <option value="{{ $bin->id }}">{{ $bin->id_bins }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-floating-label">
                                    <select class="form-control @error('ini_inven') is-invalid @enderror" for="ini_inven"
                                        id="ini_inven" name="ini_inven" required>
                                        {{-- <option value="">Choose BIN</option>
                                        @foreach ($bin as $bin)
                                            @if (old('ini_bin') == $bin->id)
                                                <option value="{{ $bin->id }}">
                                                    {{ $bin->id_bins }}</option>
                                            @else
                                                <option value="{{ $bin->id }}">{{ $bin->id_bins }}
                                                </option>
                                            @endif
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div>
                                    <input type="text" name="iDaListPart" id="iDaListPart"
                                        class="form-control input-border-bottom @error('iDaListPart') is-invalid @enderror"
                                        list="list-part" value="" placeholder="" required>
                                    @error('iDaListPart')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <datalist id="list-part">
                                        {{-- @foreach ($parts as $part)
                                            <option value="{{ $part->nama }}" data-part="{{ $part->id }}"
                                                data-uom="{{ $part->uom->nama }}">
                                                {{ $part->kd_parts }}</option>
                                        @endforeach --}}
                                    </datalist>
                                </div>
                                <div>
                                    <input type="text" name="iLot" id="iLot"
                                        class="form-control input-border-bottom @error('iLot') is-invalid @enderror"
                                        value="{{ old('iLot') }}" required>
                                    @error('iLot')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exp">Exp Date</label>
                                    <input type="date" name="exp"
                                        class="form-control @error('exp') is-invalid @enderror" required
                                        value="{{ old('exp') }}" id="exp">
                                    @error('exp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                            </div>
                            {{-- <div class="card-action">
                                <button class="btn btn-success" type="submit">Submit</button>
                                <a href="/dashboard/lots" class="btn btn-danger">Cancel</a>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengosongkan nilai input #iDaListPart dan #iLot
            function clearInputValue() {
                $('#iDaListPart').val('');
                $('#iLot').val('');
            }

            $('#ini_bin').on('change', function() {
                var getElementBin = $(this).val();

                // Mengosongkan nilai input #iDaListPart dan #iLot saat bin berubah
                clearInputValue();

                $("#list-part").html('');
                $.ajax({
                    url: '/dashboard/test/triggedBin',
                    type: "POST",
                    data: {
                        get_bin: getElementBin,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#list-part").html('');
                        $.each(result.inventoryTriggedBin, function(key, value) {
                            var invenPartId = value.part_id;
                            var invenId = value.id;
                            var partInven_nama = value.part.nama;
                            var partInven_lot = value.lot.kd_lots;
                            $("#list-part").append('<option value="' + invenId +
                                '" data-part="' + invenPartId + '" data-lot="' +
                                partInven_lot + '">' + 'Part : ' + partInven_nama +
                                ',   LOT : ' + partInven_nama + '</option>');
                        });
                    }
                });
            });

            $('#iDaListPart').on('input', function() {
                var inputVal = $(this).val();
                var selectedOption = $('#list-part option[value="' + inputVal + '"]');

                if (selectedOption.length > 0) {
                    var dataLot = selectedOption.attr('data-lot');
                    $('#iLot').val(dataLot);
                } else {
                    // Jika tidak ada opsi yang cocok, mengosongkan nilai input iLot
                    $('#iLot').val('');
                }
            });
        });
    </script>
@endsection
