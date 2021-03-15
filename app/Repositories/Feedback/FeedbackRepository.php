<?php

namespace App\Repositories\Feedback;


use App\Models\AbstractModel;
use App\Models\Feedback;

interface FeedbackRepository
{
    public function __construct(Feedback $feedback);

    public function newQuery(): AbstractModel;

    public function store(Feedback $feedback): Feedback;
}