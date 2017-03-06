<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\ContadorRegistro;
class PostContadorCodigo extends Model
{
    public $timestamps = false;
    protected $table = 'post_contador_codigo';
     protected $fillable = [
        'contador_id',
        'post_id',
         'contador'
        
    ];
    
     
}