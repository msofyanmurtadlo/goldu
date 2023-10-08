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
            <div class="card-body mt-3">
                <form class="form-horizontal" action="{{ route('transfers.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="startDate">Start Date</label>
                        <div class="col-sm-9">
                            <input type="text" name="startDate" class="form-control datepicker" id="startDate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="endDate">End Date</label>
                        <div class="col-sm-9">
                            <input type="text" name="endDate" class="form-control datepicker" id="endDate">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="network">Network</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="network" name="network_id">
                                <option selected="" disabled="">Select Network</option>
                                @foreach ($user->networkBallances as $u)
                                    <option value="{{ $u->network->id }}">
                                        {{ $u->network->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="ballance">Ballance</label>
                        <div class="col-sm-9">
                            <input type="number" step="0.01" name="ballance" class="form-control" id="ballance"
                                placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="rate">Rate</label>
                        <div class="col-sm-9">
                            <input type="number" name="rate" class="form-control" id="rate" placeholder="Rate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center mb-0" for="konversi">Amount</label>
                        <div class="col-sm-9">
                            <input type="number" name="amount" class="form-control" id="konversi">
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
                        <label class="control-label col-sm-3 align-self-center mb-0" for="method">Method</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="method" id="method"
                                value="{{ strtoupper($user->bank->bank_name . '|' . $user->bank->bank_acount . '|' . $user->bank->bank_number) }}">
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
        document.addEventListener('DOMContentLoaded', function() {
            const accessKey = "{{ $settings['BCDN_Key'] }}";
            const imgPath = "proof/";
            const fileInput = document.getElementById('image');
            fileInput.addEventListener('change', function() {
                const file = fileInput.files[0];
                if (!file) return;
                const originalFileName = file.name;
                const fileExtension = originalFileName.split('.').pop().toLowerCase();
                const fileName = new Date().getTime() + '_' + Math.random().toString(36).substring(2, 15) +
                    Math.random().toString(36).substring(2, 15) + '.' + fileExtension;
                const imgUrl = `https://mylink12.b-cdn.net/${imgPath}${fileName}`;
                document.getElementById('imgurl').value = imgUrl;
                const url = `https://storage.bunnycdn.com/mylink12/${imgPath}${fileName}`;
                fetch(url, {
                    method: 'PUT',
                    headers: {
                        'content-type': 'application/octet-stream',
                        'AccessKey': accessKey
                    },
                    body: file
                });
            });
        });

        $(document).ready(function() {
            $(".datepicker").datepicker({
                dateFormat: "dd/mm/yy"
            });

            function updateBalance() {
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();
                const networkId = $('#network').val();
                if (startDate && endDate && networkId) {
                    $.ajax({
                        url: '{{ route('get.balance', $user->id) }}',
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            startDate: startDate,
                            endDate: endDate,
                            network_id: networkId
                        },
                        success: function(data) {
                            $('#ballance').val(data.totalBalance);
                            calculateAndSetKonversi();
                        }
                    });
                }
            }
            $('#network').change(function() {
                updateBalance();
            });
            $('#startDate, #endDate, #network').change(updateBalance);

            function calculateAndSetKonversi() {
                const ballance = parseFloat($('#ballance').val()) || 0;
                const rate = parseFloat($('#rate').val()) || 0;
                $('#konversi').val((ballance * rate).toString().split('.')[0]);
            }
            $('#ballance, #rate').on('input', calculateAndSetKonversi);

            function fetchRateAndFillForm() {
                $.getJSON("https://api.binance.com/api/v3/ticker/price?symbol=USDTBIDR")
                    .done(function(data) {
                        $('#rate').val(data.price.split('.')[0]);
                        calculateAndSetKonversi();
                    });
            }
            fetchRateAndFillForm();
        });
    </script>
@endpush
