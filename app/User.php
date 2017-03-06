<?php

namespace App;
use App\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'banco','conta','agencia','image','cep','rua','complemento','numero','cidade','estado','bairro','telefone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function rules($id = '')
    {
        return [
            'name'         => "required|min:3|max:100",
            'email'           => "required|min:3|max:100",
            'password'   => 'required|min:6|max:12,unique',
            'cpf'   => 'required|min:11|max:11,unique',
            'banco'          => 'required|min:3|max:20',
            'conta'          => 'required|min:2|max:20',
            'agencia'        => 'required|min:2|max:20',
            'rua' => "required|min:3|max:100"
        ];
    }
    
    
    
    
    
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
   public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }
    
    
    public function hasPermission(Permission $permission)
    {
        
        return $this->hasAnyRoles($permission->roles);
    }
    
    public function hasAnyRoles($roles)
    {
        if(is_array($roles) || is_object($roles) ) {
            return !! $roles->intersect($this->roles)->count();
        }
        
        return $this->roles->contains('name', $roles);
    }

}
