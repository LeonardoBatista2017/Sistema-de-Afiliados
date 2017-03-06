<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;


class Permission extends Model
{
    protected $fillable = ['name', 'label'];
    
    public function rules()
    {
        return [
            'name'  => 'required|min:3|max:60',
            'label' => 'required|min:3|max:200',
        ];
    }
     public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }
   
}