<?php

namespace App\Controllers;

use Core\Request;
use App\Models\Feedback;
use App\Repositories\Feedback\PdoFeedbackRepository;
use App\Services\Feedback\FeedbackService;
use App\Services\Feedback\FeedbackServiceInterface;

class FeedbackController
{
    /** @var FeedbackServiceInterface */
    private $feedbackService;

    public function __construct()
    {
        $this->feedbackService = new FeedbackService(new PdoFeedbackRepository(new Feedback()));
    }

    public function store(Request $request)
    {
        $this->feedbackService->store($request->getData());
    }
}