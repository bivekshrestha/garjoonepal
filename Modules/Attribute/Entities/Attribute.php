<?php

namespace Modules\Attribute\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name', 'slug', 'type', 'is_filterable', 'options', 'category'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function count()
    {

    }
}
