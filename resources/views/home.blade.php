@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Dashboard</h1>
            <p>{{ $settings['Site_Description'] }}</p>
        </div>
        <div>
            <a class="btn btn-link btn-soft-light" href="{{ route('smartlinks') }}">
                <i class="fa-solid fa-dollar"></i> Get Money
            </a>
        </div>
    </div>
@endsection
@section('content')
    @include('transactions.detail')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1 ">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-01"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="{{ $linkall }}"
                                        data-value="{{ $linkuser }}" data-type="percent">
                                        <i class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                            <i class="fa-solid fa-link"></i>
                                        </i>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Links</p>
                                        <h4 class="counter">{{ $linkuser }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @foreach ($revenue as $r)
                            @foreach ($r->networkBallances as $n)
                                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                                    <div class="card-body">
                                        <div class="progress-widget">
                                            <div id="circle-progress-04"
                                                class="text-center circle-progress-01 circle-progress circle-progress-info"
                                                data-min-value="0" data-max-value="{{ $r->ballance }}"
                                                data-value="{{ $n->balance }}" data-type="percent">
                                                <svg class="card-slie-arrow icon-24" width="24px" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                                </svg>
                                            </div>
                                            <div class="progress-detail">
                                                <p class="mb-2">Network {{ $n->network->alias }}</p>
                                                <h4 class="counter"> {{ '$' . $n->balance }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endforeach
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-06"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="{{ $convertionall }}"
                                        data-value="{{ $convertionuser }}" data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">All Incomes</p>
                                        <h4 class="counter">{{ '$' . $convertionuser }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-07"
                                        class="text-center circle-progress-01 circle-progress circle-progress-info"
                                        data-min-value="0" data-max-value="{{ $bonusall }}"
                                        data-value="{{ $bonususer }}" data-type="percent">
                                        <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">All Bonuses</p>
                                        <h4 class="counter">{{ '$' . $bonususer }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-04"
                                        class="text-center circle-progress-01 circle-progress circle-progress-primary"
                                        data-min-value="0" data-max-value="{{ $ballanceall }}"
                                        data-value="{{ Auth::user()->ballance }}" data-type="percent" role="progressbar"
                                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="60">
                                        <svg class="card-slie-arrow icon-24" width="24px" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z"></path>
                                        </svg>
                                        <svg version="1.1" width="100" height="100" viewBox="0 0 100 100"
                                            class="circle-progress">
                                            <circle class="circle-progress-circle" cx="50" cy="50"
                                                r="46" fill="none" stroke="#ddd" stroke-width="8"></circle>
                                            <path d="M 50 4 A 46 46 0 1 1 22.96187839454624 87.21478174124758"
                                                class="circle-progress-value" fill="none" stroke="#00E699"
                                                stroke-width="8"></path><text class="circle-progress-text" x="50"
                                                y="50" font="16px Arial, sans-serif" text-anchor="middle"
                                                fill="#999" dy="0.4em">60%</text>
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">My Ballance</p>
                                        <h4 class="counter">{{ '$' . Auth::user()->ballance }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="500">
                        <div class="text-center card-body d-flex justify-content-around">
                            <div>
                                <h2 class="mb-2">{{ $alltraffic }}</h2>
                                <p class="mb-0 text-gray">All Traffic</p>
                            </div>
                            <hr class="hr-vertial">
                            <div>
                                <h2 class="mb-2">{{ $allconvertion }}</h2>
                                <p class="mb-0 text-gray">All Convertion</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex-wrap card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="mb-2 card-title">New Transaction List</h4>
                                <p class="mb-0">
                                    <svg class="me-2 text-primary icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                    </svg>
                                    Last 15 transactions
                                </p>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <div class="table-responsive">
                                <table id="transaction-list-table" class="table table-striped" role="grid"
                                    data-bs-toggle="data-table">
                                    <thead>
                                        <tr class="ligth">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Trx</th>
                                            <th>Network</th>
                                            <th>Type</th>
                                            <th>Ballance</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $u)
                                            <tr>
                                                <td>{{ $transactions->total() - (($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration) + 1 }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($u->created_at)->format('d/m/Y') }}</td>

                                                <td>
                                                    @if ($u->is_read == false)
                                                        <a href="javascript:void(0)"
                                                            onclick="showTransactionDetail({{ $u->id }})">
                                                            {{ '#' . $settings['Site_Name'] . '-' . $u->id }}
                                                        </a>
                                                    @else
                                                        {{ '#' . $settings['Site_Name'] . '-' . $u->id }}
                                                    @endif
                                                </td>
                                                <td>{{ $u->network->alias }}</td>
                                                <td><span
                                                        class="badge bg-{{ $u->type == 'Payout' ? 'warning' : 'success' }}">{{ $u->type }}</span>
                                                </td>

                                                <td>{{ $u->ballance < 0 ? '(-$' . number_format(abs($u->ballance), 2) . ')' : '$' . number_format($u->ballance, 2) }}
                                                </td>
                                                <td>{{ $u->amount < 0 ? '-$' . number_format(abs($u->amount), 2) : '$' . number_format($u->amount, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card credit-card-widget" data-aos="fade-up" data-aos-delay="900">
                        <div class="pb-4 border-0 card-header">
                            <div class="p-4 border border-white rounded primary-gradient-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="font-weight-bold">{{ $settings['Site_Name'] }} </h5>
                                        <P class="mb-0">BANK
                                            ({{ $user->bank->bank_name ? $user->bank->bank_name : 'Please set your bank' }})
                                        </P>
                                    </div>
                                    <div class="master-card-content">
                                        <svg class="master-card-1 icon-60" width="60" viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                        </svg>
                                        <svg class="master-card-2 icon-60" width="60" viewBox="0 0 24 24">
                                            <path fill="#ffffff"
                                                d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <div class="card-number">
                                        {{ $user->bank->bank_number ? $user->bank->bank_number : 'Please set your bank' }}
                                    </div>
                                </div>
                                <div class="mb-2 d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Card holder</p>
                                    {{-- <p class="mb-0">Expire Date</p> --}}
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6>{{ $user->bank->bank_acount ? $user->bank->bank_acount : 'Please set your bank' }}
                                    </h6>
                                    {{-- <h6 class="ms-5">06/11</h6> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="flex-wrap d-flex justify-content-between">
                                    <h2 class="mb-2">{{ '$' . Auth::user()->ballance }}</h2>
                                    <div>
                                        <span
                                            class="badge bg-success rounded-pill">{{ '@' . Auth::user()->username }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-cols-2 d-grid gap-card">
                                <button class="p-2 btn btn-primary text-uppercase">Bank Setting</button>
                                <a href="#" class="p-2 btn btn-info text-uppercase">View
                                    Payment</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // January is 0!
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        }

        function showTransactionDetail(id) {
            $.get('/transaction/' + id, function(transaction) {
                document.getElementById('transactionModalId').textContent = transaction.id;
                document.getElementById('transactionModalNetwork').textContent = transaction.network.alias;
                document.getElementById('transactionModalType').textContent = transaction.type;
                let balanceValue = parseFloat(transaction.ballance);
                if (balanceValue < 0) {
                    document.getElementById('transactionModalBalance').textContent = '-$' + Math.abs(balanceValue)
                        .toFixed(2);
                } else {
                    document.getElementById('transactionModalBalance').textContent = '$' + balanceValue.toFixed(2);
                }
                document.getElementById('transactionModalAmount').textContent = transaction.amount;
                document.getElementById('transactionModalUsername').textContent = transaction.user.username;
                document.getElementById('transactionModalDate').textContent = formatDate(transaction.created_at);
                $('#transactionDetailModal').modal('show');
                refreshTableContent(location.href);
            });
        }

        function refreshTableContent(url = location.href) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    var content = $(response).find('#transaction-list-table').parent();
                    $('#transaction-list-table').parent().replaceWith(content);
                },
                error: handleAjaxError
            });
        }


        function handleAjaxError(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                Swal.fire('Validation Error', Object.values(errors).join(', '), 'error');
            } else {
                Swal.fire('Error', xhr.statusText, 'error');
            }
        }
    </script>
@endpush
