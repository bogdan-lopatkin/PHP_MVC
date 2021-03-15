<?php


namespace App\Services\Feedback;


use App\Models\Feedback;
use App\Repositories\Feedback\FeedbackRepository;

class FeedbackService
{
    /** @var FeedbackRepository */
    private $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    final public function store(array $data = []): Feedback
    {
        $feedback = new Feedback($data);

        return $this->feedbackRepository->store($feedback);
    }
}