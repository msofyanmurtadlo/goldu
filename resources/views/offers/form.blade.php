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
                                    <label for="country" class="form-label">Country</label>
                                    <select id="country" class="form-control @error('country') is-invalid @enderror"
                                        name="country" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countryOptions as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="url_mobile" class="form-label">Url Mobile</label>
                                    <input id="url_mobile" type="text"
                                        class="form-control @error('url_mobile') is-invalid @enderror" name="url_mobile"
                                        value="{{ old('url_mobile') }}" required autocomplete="url_mobile" autofocus>
                                    @error('url_mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="url_desktop" class="form-label">Url Desktop</label>
                                    <input id="url_desktop" type="text"
                                        class="form-control @error('url_desktop') is-invalid @enderror"
                                        name="url_desktop" value="{{ old('url_desktop') }}" required
                                        autocomplete="url_desktop" autofocus>
                                    @error('url_desktop')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
