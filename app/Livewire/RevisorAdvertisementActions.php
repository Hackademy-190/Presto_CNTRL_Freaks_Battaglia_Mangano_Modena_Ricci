<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Livewire\Component;

class RevisorAdvertisementActions extends Component
{
    public Advertisement $advertisement;

    public function mount(Advertisement $advertisement): void
    {
        $this->advertisement = $advertisement;
    }

    public function approve(): void
    {
        $this->updateReviewStatus(true, 'reviewerApproved');
    }

    public function reject(): void
    {
        $this->updateReviewStatus(false, 'reviewerRejected');
    }

    public function sendBackToReview(): void
    {
        $this->updateReviewStatus(null, 'reviewerPending');
    }

    public function render()
    {
        return view('livewire.revisor-advertisement-actions');
    }

    private function updateReviewStatus(?bool $isAccepted, string $messageKey): void
    {
        abort_unless(auth()->user()?->is_revisor, 403);

        $this->advertisement = Advertisement::findOrFail($this->advertisement->id);
        $this->advertisement->setAccepted($isAccepted);

        session()->flash('message', __(
            'ui.'.$messageKey,
            ['title' => $this->advertisement->title],
        ));
    }
}
