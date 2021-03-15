<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;

trait With
{
    /**
     * @param string|array $with
     */
    public function with($with): self
    {
        if (is_string($with)) {
            $with = [$with];
        }

        $this->with = $with;

        return $this;
    }
}