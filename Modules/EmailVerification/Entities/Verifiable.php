<?php

namespace Modules\EmailVerification\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Verifiable extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\EmailVerification\Database\factories\VerifiableFactory::new();
    }
}
