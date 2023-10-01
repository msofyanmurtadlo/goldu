@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Settings</h1>
            <p>General settings are customizable options that define the fundamental aspects of a website or application,
                such as its title, appearance, and default behavior.</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">General Setting</h4>
                        </div>
                    </div>
                    <div class="card-body" id="view-settings">
                        <!-- Tampilan pengaturan -->
                        @foreach ($settings as $key => $value)
                            <div class="mb-3">
                                <label for="{{ $key }}"
                                    class="form-label">{{ str_replace('_', ' ', $key) }}</label>
                                <input type="text" name="{{ $key }}" id="{{ $key }}"
                                    class="form-control" value="{{ $value }}" disabled>
                            </div>
                        @endforeach
                        <a href="#" id="edit-settings-button" class="btn btn-primary">Edit Settings</a>
                    </div>

                    <div class="card-body" id="edit-settings" style="display: none;">
                        <!-- Mode Edit -->
                        <form action="{{ route('settings.update') }}" method="POST" id="settings-form">
                            @csrf
                            @foreach ($settings as $key => $value)
                                <div class="mb-3">
                                    <label for="{{ $key }}"
                                        class="form-label">{{ str_replace('_', ' ', $key) }}</label>
                                    <input type="text" name="{{ $key }}" id="{{ $key }}"
                                        class="form-control" value="{{ $value }}">
                                </div>
                            @endforeach
                            <a href="#" id="cancel-edit-button" class="btn btn-secondary">Cancel Edit</a>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // JavaScript untuk mengganti mode tampilan
        $(document).ready(function() {
            const viewSettings = $('#view-settings');
            const editSettings = $('#edit-settings');
            const editButton = $('#edit-settings-button');
            const cancelButton = $('#cancel-edit-button');
            const settingsForm = $('#settings-form');

            // Ketika tombol "Edit Settings" ditekan
            editButton.click(function(e) {
                e.preventDefault();
                viewSettings.hide();
                editSettings.show();
            });

            // Ketika tombol "Cancel Edit" ditekan
            cancelButton.click(function(e) {
                e.preventDefault();
                editSettings.hide();
                viewSettings.show();
            });

            // Ketika formulir disubmit (mode edit)
            settingsForm.submit(function(e) {
                e.preventDefault();
                const formData = settingsForm.serialize();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will update this settings.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Update!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user clicks "Yes, Delete!" in SweetAlert
                        $.ajax({
                            url: "{{ route('settings.update') }}",
                            type: "POST",
                            data: formData,
                            success: function(response) {
                                // Redirect ke URL yang diberikan dalam respons JSON
                                window.location.href = response.redirect;

                                // Ubah tampilan ke mode tampilan
                                viewSettings.show();
                                editSettings.hide();
                            },
                        });
                    }
                });
            });
        });
    </script>
@endpush
