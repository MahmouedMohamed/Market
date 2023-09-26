<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends BaseModel
{
    public $timestamps = false;

    /**
     * Get the parent imageable model (user or post).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
