<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContadorRegistro extends Model
{
    protected $fillable = ['contador', 'user_id', 'codigo','id'];
      public $timestamps = false;
    protected $table = 'contador_registro';
    protected $primaryKey = 'codigo';
    protected $guarded = ['codigo'];
    public function rules($id = '')
    {
        return [
            
            
          
        ];
    }
    
    public function contadores(){
      
         return $this->hasMany('App\Users','id','user_id');
    }
    
    
}