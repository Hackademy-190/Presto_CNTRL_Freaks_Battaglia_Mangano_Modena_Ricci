<div class="d-flex pb-4" wire:key="review-actions-{{ $advertisement->id }}">
    @if ($advertisement->is_accepted === null)
        <button
            type="button"
            wire:click="reject"
            wire:loading.attr="disabled"
            class="btn btn-danger py-2 mt-5 px-5 fw-bold me-4"
        >
            {{ __('ui.reject') }}
        </button>
        <button
            type="button"
            wire:click="approve"
            wire:loading.attr="disabled"
            class="btn btn-success py-2 mt-5 px-5 fw-bold"
        >
            {{ __('ui.approve') }}
        </button>
    @else
        <button
            type="button"
            wire:click="sendBackToReview"
            wire:loading.attr="disabled"
            class="btn ad-card-action w-100 py-2 mt-5 fw-bold"
        >
            {{ __('ui.sendBackToReview') }}
        </button>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success text-center shadow rounded ms-3 mb-0" role="status">
            {{ session('message') }}
        </div>
    @endif
</div>
