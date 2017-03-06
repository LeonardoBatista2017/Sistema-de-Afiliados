<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentAnswer extends Model
{
    protected $fillable = ['description', 'date', 'hour', 'user_id'];
}