<?php

namespace App\Repositories\Feedback;

use App\Models\AbstractModel;
use App\Models\Feedback;

class PdoFeedbackRepository implements FeedbackRepository
{
    /** @var Feedback */
    private $model;

    public function __construct(Feedback $model)
    {
        $this->model = $model;
    }

    final public function store(Feedback $feedback): Feedback
    {
        $feedback->save();

        return $feedback;
    }

    public function newQuery(): AbstractModel
    {
        return $this->model->newQuery();
    }
}