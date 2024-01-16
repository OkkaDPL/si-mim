@extends('dashboard.layouts.main')

@section('isibody')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <form action="/dashboard/inventories/adjustStock/{{ $inventory->id }}" method="POST">
                        @method('put')
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
                                            <th style="width: 35%">Stock On</th>
                                            <th style="width: 35%">Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select
                                                    class="form-control iniSelect2 @error('bin_id') is-invalid @enderror"
                                                    for="bin_id" id="bin_id" name="bin_id" required>
                                                    <option value="{{ $inventory->bin->id }}" selected>
                                                        {{ $inventory->bin->customer->nama }}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control iniSelect2 @error('type') is-invalid @enderror"
                                                    for="type" id="type" name="type" required>
                                                    <option value="" selected>
                                                        Choose Type</option>
                                                    @if (old('type') == 'Adjust In')
                                                        (
                                                        <option value="Adjust In" selected>
                                                            Adjust In</option>
                                                        )
                                                    @elseif(old('type') == 'Adjust Out')
                                                        (
                                                        <option value="Adjust Out" selected>
                                                            Adjust Out</option>
                                                        )
                                                    @else
                                                        (
                                                        <option value="Adjust In">
                                                            Adjust In</option>
                                                        <option value="Adjust Out">
                                                            Adjust Out</option>
                                                        )
                                                    @endif
                                                </select>
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
                                                <th>Part</th>
                                                <th>Desc</th>
                                                <th>UOM</th>
                                                <th>QTY</th>
                                                <th>LOT</th>
                                                <th>Expired Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="idInventory" id="idInventory"
                                                        class="iniSelect2 form-control @error('type') is-invalid @enderror"
                                                        required>
                                                        <option value="{{ $inventory->id }}">
                                                            {{ $inventory->part->kd_parts }}</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="partNama form-control input-border-bottom"
                                                        value="{{ $inventory->part->nama }}" disabled>
                                                </td>
                                                <td>
                                                    <input type="text" class="uom form-control input-border-bottom"
                                                        disabled value="{{ $inventory->part->uom->nama }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="qty" id="qty"
                                                        class="form-control input-border-bottom" value=""
                                                        min="1">
                                                    <input type="number" name="realQty" id="realQty"
                                                        value="{{ $inventory->qty }}" hidden>
                                                </td>
                                                <td>
                                                    <input type="text" name="lot" id="lot"
                                                        class="form-control input-border-bottom"
                                                        value="{{ $inventory->lot->kd_lots }}" disabled>
                                                </td>
                                                <td>
                                                    <input type="text" name="exp" id="exp"
                                                        class="form-control input-border-bottom"
                                                        value="{{ $inventory->lot->exp }}" disabled>
                                                </td>
                                            </tr>
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
                                    onclick="return confirm('Are you sure to submit the form?')">
                                    Submit
                                </button>
                                <a href="/dashboard/inventory" class="btn btn-danger"
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
            $('.iniSelect2').select2({
                width: '100%'
            });
        });
        var elRealQty = $('#realQty');
        var elQty = $('#qty');
        var elType = $('#type');
        elQty.on('input', function() {
            var valElRQty = elRealQty.val();
            var thisVal = $(this).val();
            var valElType = $('#type').val();
            var forOut = valElRQty - thisVal;

            if (valElType === 'Adjust Out') {
                if (forOut <= 0) {
                    this.setCustomValidity("Out of stock!");
                    console.log('Stock Tidak Tersedia');
                } else {
                    this.setCustomValidity("");
                    $(this).prop('required', true);
                }
            } else {
                this.setCustomValidity("");
                $(this).prop('required', true);
            }

        });

        elType.on('change', function() {
            elQty.val('');
            elQty.prop('required', true);

        });
    </script>
@endsection
