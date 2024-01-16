@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/users/{{ $user->id }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group form-floating-label">
                                    <input id="username" name="username" type="text"
                                        class="form-control input-border-bottom @error('username') is-invalid @enderror"
                                        required value="{{ old('username', $user->username) }}">
                                    <label for="username" class="placeholder">Username</label>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="email" name="email" type="email"
                                        class="form-control input-border-bottom @error('email') is-invalid @enderror"
                                        required value="{{ old('email', $user->email) }}">
                                    <label for="email" class="placeholder">Nama</label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-floating-label">
                                    <input id="password" name="password" type="text"
                                        class="form-control input-border-bottom @error('password') is-invalid @enderror"
                                        required value="{{ old('password', $user->password) }}">
                                    <label for="password" class="placeholder">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="departement">Departement</label>
                                    <select for="departement" id="departement" name="departement"
                                        class="iniSelect form-control @error('departement') is-invalid @enderror" required>
                                        <option value="IT"
                                            {{ old('departement', $user->departement) == 'IT' ? 'selected' : '' }}>
                                            IT</option>
                                        <option value="Management"
                                            {{ old('departement', $user->departement) == 'Management' ? 'selected' : '' }}>
                                            Management
                                        </option>
                                        <option value="Billing"
                                            {{ old('departement', $user->departement) == 'Billing' ? 'selected' : '' }}>
                                            Billing</option>
                                        <option value="Finance and Accounting"
                                            {{ old('departement', $user->departement) == 'Finance and Accounting' ? 'selected' : '' }}>
                                            Finance and Accounting</option>
                                        <option value="HRD"
                                            {{ old('departement', $user->departement) == 'HRD' ? 'selected' : '' }}>
                                            HRD
                                        </option>
                                        <option value="Product"
                                            {{ old('departement', $user->departement) == 'Product' ? 'selected' : '' }}>
                                            Product
                                        </option>
                                        <option value="Warehouse"
                                            {{ old('departement', $user->departement) == 'Warehouse' ? 'selected' : '' }}>
                                            Warehouse
                                        </option>
                                        <option value="Sales"
                                            {{ old('departement', $user->departement) == 'Sales' ? 'selected' : '' }}>
                                            Sales
                                        </option>
                                    </select>
                                    @error('departement')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-primary" type="submit"
                                    onclick="return confirm('Are you sure for submit this form?')">Submit</button>
                                <a href="/dashboard/users" class="btn btn-danger"
                                    onclick="return confirm('Are you sure for cancel this form?')">Cancel</a>
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
        });
    </script>
@endsection
