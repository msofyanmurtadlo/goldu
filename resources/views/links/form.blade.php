<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Generate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="bd-example">
                    <form class="row g-3 needs-validation" novalidate="" action="{{ route('link.generate') }}"
                        method="POST" id="generateForm">
                        @csrf
                        <div class="col-12">
                            <select class="form-select" id="validationCustom04" required="" name="network">
                                <option selected="" disabled="" value="">Choose Network</option>
                                @foreach ($network as $u)
                                    <option value="{{ $u->alias }}">Network {{ '(' . $u->alias . ')' }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" id="generateButton">
                                <i class="fas fa-link"></i> Generate Link
                            </button>
                        </div>
                    </form>
                    <div class="row mt-4" id="resultRow" hidden>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control " id="result1" rows="2" onclick="copyText(this)"></textarea>
                                    <textarea class="form-control mt-3" id="result2" rows="3" onclick="copyText(this)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
