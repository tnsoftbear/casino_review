<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casino extends Model
{
    use HasFactory;

    protected $table = 'casino';
    protected $fillable = ['name', 'rubric_id', 'site_url', 'description'];
}
