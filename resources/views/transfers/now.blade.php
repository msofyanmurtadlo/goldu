@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Transfer</h1>
            <p>Transfer balance to {{ $user->name }}</p>
        </div>
    </div>
@endsection
@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Transfer to username : <span class="badge bg-secondary">{{ '@' . $user->username }}
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="startdate">Start Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" id="startdate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="enddate">End Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" id="enddate">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="network">Network</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="network">
                                <option selected="" disabled="">Select Network</option>
                                @foreach ($user->networkBallances as $u)
                                    <option value="{{ $u->network->id }}" data-balance="{{ $u->balance }}">
                                        {{ $u->network->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="ballance">Ballance</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="ballance" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="rate">Rate</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="rate" placeholder="Rate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="konversi">Amount</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="konversi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="imgurl">Proof (img)</label>
                        <div class="col-sm-9">
                            <div class="input-group align-items-center">
                                <input type="text" name="imgurl" id="imgurl" class="form-control form-control-sm"
                                    placeholder="https://">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <label for="image" class="btn btn-success btn-sm mb-0">
                                            <i class="fas fa-upload"></i> Upload Image
                                            <input type="file" name="image" id="image" accept="image/*"
                                                style="display: none;">
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="method">Bank Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="method"
                                value="{{ strtoupper('(' . $user->bank->bank_name . '|' . $user->bank->bank_acount . '|' . $user->bank->bank_number . ')') }}">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Transfer Now</button>
                        <a href="{{ route('transfers') }}" class="btn btn-danger">cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $(".datepicker").datepicker({
                dateFormat: "dd/mm/yy" // Format tanggal dd/mm/yyyy
            });
            $('#network').change(function() {
                let selectedNetworkId = $(this).val();
                let selectedBalance = $('option:selected', this).data('balance');
                $('#ballance').val(selectedBalance);
                calculateAndSetKonversi();
            });

            function calculateAndSetKonversi() {
                const ballance = parseFloat($('#ballance').val()) || 0;
                const rate = parseFloat($('#rate').val()) || 0;
                const konversiValue = (ballance * rate).toString().split('.')[0];
                $('#konversi').val(konversiValue);
            }
            $('#ballance, #rate').on('input', calculateAndSetKonversi);

            function fetchRateAndFillForm() {
                const url = "https://open.er-api.com/v6/latest/USD";

                $.getJSON(url)
                    .done(function(data) {
                        const rate_to_idr = data.rates.IDR.toString().split('.')[0];
                        $('#rate').val(rate_to_idr);
                        calculateAndSetKonversi();
                    })
                    .fail(function(jqxhr, textStatus, error) {
                        const err = textStatus + ", " + error;
                        console.log("Request Failed: " + err);
                    });
            }
            fetchRateAndFillForm();
        });
    </script>
@endpush
