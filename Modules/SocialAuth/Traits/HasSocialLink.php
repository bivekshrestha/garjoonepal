<?php

namespace Modules\SocialAuth\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\SocialAuth\Entities\SocialUser;

trait HasSocialLink
{
    /**
     * @return HasOne
     */
    public function social(): HasOne
    {
        return $this->hasOne(SocialUser::class);
    }
}
