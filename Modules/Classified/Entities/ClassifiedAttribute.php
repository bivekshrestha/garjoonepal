<?php

namespace Modules\Classified\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassifiedAttribute extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function classified(): BelongsTo
    {
        return $this->belongsTo(Classified::class);
    }
}
