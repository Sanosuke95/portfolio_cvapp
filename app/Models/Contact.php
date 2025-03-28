<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperContact
 */
class Contact extends Model
{

    use HasFactory;
    /**
     * The all fields for the model
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'subject',
        'content'
    ];

    /**
     * Boot helper
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
