<?php

namespace App\Models;

use App\Traits\HasPermissionTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\Entities\LoginLog;
use Modules\Auth\Entities\UserSecurity;
use Modules\Cart\Entities\Cart;
use Modules\Product\Entities\Product;
use Modules\Review\Entities\Review;
use Modules\SocialAuth\Traits\HasSocialLink;
use Modules\Store\Entities\Store;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasPermissionTrait, HasApiTokens, HasSocialLink;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'is_active',
        'is_paused',
        'has_accepted_policy',
        'has_accepted_terms',
        'is_verified',
        'has_logged_in',
        'token',
        'email_verified_at',
        'activated_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @param $roleSlug
     */
    public function attachRole($roleSlug)
    {
        $role = Role::where('slug', $roleSlug)->first();
        $this->roles()->attach($role);
    }

    /**
     * Generate Tokens
     */
    public function generateToken()
    {
        $this->token = sha1(md5(microtime())) . Str::random(64) . md5(sha1(microtime()));
        $this->save();
    }

    /**
     * @return mixed
     */
    public function availableRoles()
    {
        return $this->roles();
    }

    /**
     * @return HasOne
     */
    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasOne
     */
    public function log(): HasOne
    {
        return $this->hasOne(LoginLog::class);
    }

    /**
     * @return HasOne
     */
    public function security(): HasOne
    {
        return $this->hasOne(UserSecurity::class);
    }

    /**
     * @return HasMany
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class)->with('product.discount');
    }

    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
