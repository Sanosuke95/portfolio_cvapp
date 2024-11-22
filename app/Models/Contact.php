<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Contact extends Model
{
    /**
     * Generate uuid
     */
    public function newUUID()
    {
        return Uuid::uuid4();
    }

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
}
