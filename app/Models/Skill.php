<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperSkill
 */
class Skill extends Model
{
    /**
     * The all fields for the model
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'level'
    ];

    /**
     * Boot helper
     *
     * @return void
     */
    protected static function boot()
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

    /**
     * Get user parent
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'user_id');
    }


    /**
     * Get resume parent for own skill
     */
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class, 'foreign_key', 'resume_id');
    }
}
