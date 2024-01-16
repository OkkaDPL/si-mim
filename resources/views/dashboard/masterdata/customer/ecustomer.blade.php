@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/customers/{{ $customer->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <input id="nama" name="nama" type="text"
                                        class="form-control input-border-bottom @error('nama') is-invalid @enderror"
                                        required value="{{ old('nama', $customer->nama) }}">
                                    <label for="nama" class="placeholder">Name</label>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="tlp" name="tlp" type="text" pattern="[0-9]{7,13}"
                                        class="form-control input-border-bottom @error('tlp') is-invalid @enderror" required
                                        value="{{ old('tlp', $customer->tlp) }}">
                                    <label for="tlp" class="placeholder">Phone number</label>
                                    @error('tlp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="email" name="email" type="email"
                                        class="form-control input-border-bottom @error('email') is-invalid @enderror"
                                        required value="{{ old('email', $customer->email) }}">
                                    <label for="email" class="placeholder">E-mail</label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="comment">Address</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" required id="alamat" name="alamat"
                                        type="text" rows="5">{{ old('alamat', $customer->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <select for="snpwp" id="snpwp" name="snpwp"
                                        class="form-control @error('snpwp') is-invalid @enderror" required>>
                                        <option value="Ya"
                                            {{ old('snpwp', $customer->snpwp) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak"
                                            {{ old('snpwp', $customer->snpwp) == 'Tidak' ? 'selected' : '' }}>Tidak
                                        </option>
                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">NPWP</label>
                                    @error('snpwp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="nonpwp" name="nonpwp" type="text"
                                        pattern="[0-9]{2}.[0-9]{2}.[0-9]{3}.[0-9]{1}-[0-9]{3}.[0-9]{3}"
                                        class="form-control input-border-bottom @error('nonpwp') is-invalid @enderror"
                                        value="{{ old('nonpwp', $customer->nonpwp) }}"
                                        placeholder="Valid format: XX.XX.XXX.X-XXX.XXX">
                                    <label for="lnpwp" id="lnpwp" class="placeholder">NPWP number</label>
                                    @error('nonpwp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit"
                                    onclick="return confirm('Are you sure to submit the form?')">Submit</button>
                                <a href="/dashboard/customers" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to cancel the form?')">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Mengambil elemen select dengan id snpwp
        var snpwp = document.getElementById("snpwp");
        // Mengambil elemen input dengan id nonpwp
        var nonpwp = document.getElementById("nonpwp");
        // Mengambil elemen input dengan id nomnpwp
        var nomnpwp = document.getElementById("lnpwp");
        // Menetapkan nilai awal snpwp dari database
        var snpwpValue = "{{ $customer->snpwp }}";
        // Jika nilai snpwp dari database adalah "Ya", tampilkan input nonpwp dan label nomnpwp
        if (snpwpValue == "Ya") {
            nonpwp.style.display = "block";
            lnpwp.style.display = "block";
        } else if (snpwp.value == "Ya") {
            nonpwp.style.display = "block";
            lnpwp.style.display = "block";
        } else {
            nonpwp.style.display = "none";
            nomnpwp.style.display = "none";
            nonpwp.value = "";
        }
        // Menambahkan event listener untuk perubahan nilai pada select snpwp
        snpwp.addEventListener("change", function() {
            if (snpwp.value == "Ya") {
                // Jika nilai Ya dipilih, tampilkan input nonpwp
                nonpwp.style.display = "block";
                nomnpwp.style.display = "block";
                nonpwp.value = "{{ $customer->nonpwp }}"
            } else {
                // Jika nilai Tidak dipilih, sembunyikan input nonpwp dan kosongkan nilainya
                nonpwp.style.display = "none";
                nomnpwp.style.display = "none";
                nonpwp.value = "";
            }
        });
    </script>
@endsection
