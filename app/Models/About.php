<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Models;

class About extends Model
{
    use Factory;

    protected $table = 'abouts';

    protected $fillable = [
        'user_id',
        'description',
        'profesional_vision',
        'mission',
        'location',
        'dat_of_bird',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];


    /**
     * 
     */

    public function user()
    {
        return $this ->belongsTo(user::class);
    }
}