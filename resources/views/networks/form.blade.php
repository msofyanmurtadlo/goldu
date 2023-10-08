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
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alias" class="form-label">Alias</label>
                                    <input id="alias" type="text"
                                        class="form-control @error('alias') is-invalid @enderror" name="alias"
                                        value="{{ old('alias') }}" required autocomplete="alias" autofocus>
                                    @error('alias')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="smartlink" class="form-label">Smartlink</label>
                                    <input id="smartlink" type="text"
                                        class="form-control @error('smartlink') is-invalid @enderror" name="smartlink"
                                        value="{{ old('smartlink') }}" required autocomplete="smartlink" autofocus>
                                    @error('smartlink')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tracker" class="form-label">Track(Ref)</label>
                                    <input id="tracker" type="text"
                                        class="form-control @error('tracker') is-invalid @enderror" name="tracker"
                                        value="{{ old('tracker') }}" autocomplete="tracker" autofocus>
                                    @error('tracker')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sub1" class="form-label">Sub1</label>
                                    <input id="sub1" type="text"
                                        class="form-control @error('sub1') is-invalid @enderror" name="sub1"
                                        value="{{ old('sub1') }}" autocomplete="sub1" autofocus>
                                    @error('sub1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cid" class="form-label">Click ID</label>
                                    <input id="cid" type="text"
                                        class="form-control @error('cid') is-invalid @enderror" name="cid"
                                        value="{{ old('cid') }}" autocomplete="cid" autofocus>
                                    @error('cid')
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
