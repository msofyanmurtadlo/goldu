<style>
    .modal-header {
        justify-content: space-between;
    }
</style>
<div class="modal fade" id="transactionDetailModal" tabindex="-1" aria-labelledby="transactionDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light border-0">

                <div class="logo-main">
                    <div class="logo-normal">
                        <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                        </svg>
                    </div>
                    <div class="logo-mini">
                        <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                                transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                                transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                                transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                                transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                        </svg>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>{{ $settings['Site_Name'] }} Network</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <h5 class="mb-3">Details Transactions</h5>
                        <p><strong>ID:</strong> {{ '#' . $settings['Site_Name'] . '-' }}<span
                                id="transactionModalId"></span></p>
                        <p><strong>Date:</strong> <span id="transactionModalDate"></span></p>
                        <p><strong>Username:</strong> <span id="transactionModalUsername"></span></p>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Network</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span id="transactionModalType"></span></td>
                            <td><span id="transactionModalNetwork"></span></td>
                            <td><span id="transactionModalBalance"></span></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row mt-4">
                    <div class="col-md-8">
                        <p>Notes: all calculated automatically by the system</p>
                    </div>
                    <div class="col-md-4 text-right">
                        <h5>Total: $<span id="transactionModalAmount"></span></h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
