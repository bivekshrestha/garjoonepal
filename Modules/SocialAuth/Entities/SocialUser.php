<?php

namespace Modules\SocialAuth\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     * Make sure to use HasSocialLink Trait in User Model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
