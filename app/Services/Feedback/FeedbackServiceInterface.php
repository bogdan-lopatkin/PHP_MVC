<?php


namespace App\Services\Feedback;


use App\Models\Feedback;

interface FeedbackServiceInterface
{
    public function __construct();

    public function store(array $data = []): Feedback;

}