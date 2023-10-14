@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Smartlinks</h1>
            <p>A "smartlink" is a dynamic URL that adjusts its destination based on criteria like device type or location,
                providing a tailored user experience.</p>
        </div>
        <div>
            <a class="btn btn-link btn-soft-light" href="" data-bs-toggle="modal" data-bs-target="#formModal">
                <i class="fa-solid fa-link"></i> Smartlinks
            </a>
        </div>
    </div>
@endsection
@section('content')
    @include('links.form')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title mb-0 me-3">List</h4>
                    </div>
                    <div>
                        <div class="input-group">
                            <div id="dateRangePicker"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="smartlink-list-table" class="table table-striped" role="grid"
                            data-bs-toggle="data-table">
                            <thead>
                                <tr class="ligth">
                                    <th>#</th>
                                    <th>Link Host</th>
                                    <th>Link Host + Alias</th>
                                    @can('admin')
                                        <th>Pemilik</th>
                                    @endcan
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($smartlinks as $u)
                                    <tr>
                                        <td>{{ $smartlinks->total() - (($smartlinks->currentPage() - 1) * $smartlinks->perPage() + $loop->iteration) + 1 }}
                                        </td>

                                        <td>{{ 'https://' . $u->host }}</td>
                                        <td>{{ 'https://' . $u->host . '/' . $u->alias }}</td>
                                        @can('admin')
                                            <td>
                                                <span class="badge bg-warning">{{ '@' . $u->user->username }}</span>
                                            </td>
                                        @endcan
                                        <td>
                                            <div class="flex align-items-center list-network-action">
                                                <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Delete"
                                                    data-bs-original-title="Delete"
                                                    onclick="deleteData('{{ route('links.destroy', $u->id) }}')">
                                                    <span class="btn-inner">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            stroke="currentColor">
                                                            <path
                                                                d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                            <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul>
                                {!! $smartlinks->links() !!}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var picker = $('#dateRangePicker').data('daterangepicker');
            if (picker.startDate && picker.endDate) {
                url += (url.indexOf('?') !== -1 ? '&' : '?') + 'startDate=' + picker.startDate.format(
                    'YYYY-MM-DD') + '&endDate=' + picker.endDate.format('YYYY-MM-DD');
            }

            refreshTableContent(url);
        });


        function refreshTableContent(url = location.href) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    var content = $(response).find('#smartlink-list-table').parent();
                    $('#smartlink-list-table').parent().replaceWith(content);
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

        $(document).ready(function() {
            $('#dateRangePicker').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            });

            $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).find('span').html(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate
                    .format('MMMM D, YYYY'));

                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');

                var url = '{{ url('smartlinks') }}?startDate=' + startDate + '&endDate=' + endDate;
                refreshTableContent(url);
            });

            $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).find('span').html('');
                var url = '{{ url('smartlinks') }}';
                refreshTableContent(url);
            });
        });

        function deleteData(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will delete this link.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        success: function(response) {
                            refreshTableContent();
                        },
                        error: handleAjaxError
                    });
                }
            });
        }

        $('#generateForm').submit(function(event) {
            event.preventDefault();

            $('#generateButton').prop('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#generateButton').prop('disabled', false);
                    $('#result1').val('');
                    $('#result2').val('');
                    $.each(response.results, function(index, result) {
                        $('#result1').val($('#result1').val() + result.resultHost +
                            '\n');
                        $('#result2').val($('#result2').val() + result
                            .resultHostAlias + '\n');
                    });
                    $('#resultRow').removeAttr('hidden');
                    refreshTableContent();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error submitting form:', textStatus, errorThrown);
                    $('#generateButton').prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error: ' + jqXHR.responseJSON.error
                    });
                }
            });
        });

        function copyText(element) {
            element.select();
            document.execCommand('copy');
        }
    </script>
@endpush
