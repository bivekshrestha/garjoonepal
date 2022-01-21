<?php

namespace Modules\Product\Entities;

use App\Models\Image;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Cart\Entities\Cart;
use Modules\Category\Entities\Category;
use Modules\Discount\Entities\Discount;
use Modules\Review\Entities\Review;
use Modules\Store\Entities\Store;
use Modules\Wishlist\Entities\Wishlist;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    protected $hidden = ['updated_at'];

    protected $casts = [
        'map_lng_lat' => 'array'
    ];

    protected $with = ['discount'];

    protected $dates = ['starts_on', 'ends_on'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * @param $value
     */
    public function setMapLngLatAttribute($value)
    {
        $this->attributes['map_lng_lat'] = collect(explode(', ', $value));
    }

    /**
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'image');
    }

    /**
     * @return MorphOne
     */
    public function thumbnail(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'thumbnail');
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasOne
     */
    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class)
            ->select('product_id', 'rate', 'starts_on', 'ends_on')
            ->whereDate('starts_on', '<=', today())
            ->whereDate('ends_on', '>=', today());
    }

    /**
     * @return HasOne
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * @return HasOne
     */
    public function wishlist(): HasOne
    {
        return $this->hasOne(Wishlist::class);
    }

    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
