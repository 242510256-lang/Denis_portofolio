<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'id_project';

    protected $fillable = [
        'user_id',
        'nama_project',
        'deskripsi',
        'thumbnail'
    ];
}