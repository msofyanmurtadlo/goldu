<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="bd-example">
                    <form>
                        <input type="hidden" name="_method" value="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">Full {{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input id="username" type="username"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="id_card">ID
                                    Card</label>
                                <div class="input-group align-items-center">
                                    <input type="text" name="id_card" id="id_card"
                                        class="form-control form-control-sm" placeholder="https://">
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select id="is_active" class="form-select @error('is_active') is-invalid @enderror"
                                        name="is_active" required>
                                        <option value="1" {{ old('is_active') === '1' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>

                                    @error('is_active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="custom_fee" class="form-label">{{ __('Custom Fee') }}</label>
                                    <select id="custom_fee"
                                        class="form-control @error('custom_fee') is-invalid @enderror"
                                        name="custom_fee">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>

                                    @error('custom_fee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Conditionally render the "fee" input field based on the selected value --}}
                            <div class="col-lg-12" id="feeField" style="display: none;">
                                <div class="form-group">
                                    <label for="fee" class="form-label">{{ __('Fee') }}</label>
                                    <input id="fee" type="number"
                                        class="form-control @error('fee') is-invalid @enderror" name="fee"
                                        value="{{ old('fee') }}">

                                    @error('fee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <button
                    type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
