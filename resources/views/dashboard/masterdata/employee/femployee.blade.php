@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/employees" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <input id="nama" name="nama" type="text"
                                        class="form-control input-border-bottom @error('nama') is-invalid @enderror"
                                        required value="{{ old('nama') }}">
                                    <label for="nama" class="placeholder">Name</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bod">Birth of Date</label>
                                    <input type="date" name="bod"
                                        class="form-control @error('bod') is-invalid @enderror" required
                                        value="{{ old('bod') }}" id="bod">
                                    @error('bod')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="tlp" name="tlp" type="text" pattern="[0-9]{7,13}"
                                        class="form-control input-border-bottom @error('tlp') is-invalid @enderror" required
                                        value="{{ old('tlp') }}">
                                    <label for="tlp" class="placeholder">Phone Number</label>
                                    @error('tlp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <a>Email</a>
                                    <select class="iniSelect form-control @error('user_id') is-invalid @enderror"
                                        for="user_id" id="user_id" name="user_id" required>
                                        <option value="" selected>Select Email</option>
                                        @foreach ($users as $user)
                                            @if (old('user_id') == $user->id)
                                                <option value="{{ $user->id }}"
                                                    departement="{{ $user->departement }}"selected>{{ $user->email }}
                                                </option>
                                            @else
                                                <option value="{{ $user->id }}"
                                                    departement="{{ $user->departement }}">{{ $user->email }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_msk">Entry Date</label>
                                    <input type="date" name="tgl_msk"
                                        class="form-control @error('tgl_msk') is-invalid @enderror" required
                                        value="{{ old('tgl_msk') }}" id="tgl_msk">
                                    @error('tgl_msk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <a>Departement</a>
                                    <input type="text" name="departement"
                                        class="form-control @error('departement') is-invalid @enderror" readonly
                                        value="{{ old('departement') }}" id="departement">
                                    @error('departement')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <a id="lDivision" hidden>Division</a>
                                    <select class="form-control @error('division') is-invalid @enderror" for="division"
                                        id="division" name="division" hidden>
                                        <option value="" selected>Select Division</option>
                                        @foreach ($division as $division)
                                            @if (old('division') == $division->nama)
                                                <option value="{{ $division->nama }}" selected>{{ $division->nama }}
                                                </option>
                                            @else
                                                <option value="{{ $division->nama }}">
                                                    {{ $division->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('division')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <a>Status</a>
                                    <select for="status" id="status" name="status"
                                        class="iniSelect form-control @error('status') is-invalid @enderror" required>
                                        <option value="">Select Status</option>
                                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                                            Aktif</option>
                                        <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>
                                            Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">Submit</button>
                                <a href="/dashboard/employees" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to cancel the form?')">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.iniSelect').select2();

            var elBod = $('#bod');
            var elTglMsk = $('#tgl_msk');
            var elUserId = $('#user_id');
            var elDepartement = $('#departement');
            var elDivision = $('#division');
            var elLabelDivision = $('#lDivision');

            elUserId.on('change', function() {
                var selectOption = $(this).find(
                    'option:selected');
                var getAttribut = selectOption.attr('departement');
                elDepartement.val(getAttribut);

                if (getAttribut === 'Product' || getAttribut === 'Sales') {
                    elDivision.prop('hidden', false)
                    elLabelDivision.prop('hidden', false)
                    elDivision.prop('required', true)
                    elDivision.select2()
                } else {
                    elDivision.prop('hidden', true)
                    elLabelDivision.prop('hidden', true)
                    elDivision.prop('required', false)
                    elDivision.select2()
                    elDivision.select2('destroy')
                }
                // elDivision.select2();

                // console.log(kocak);
            })

            elBod.on('change', function() {
                elTglMsk.val('')
                elTglMsk.attr('min', elBod.val());
            });
        });
    </script>
@endsection
