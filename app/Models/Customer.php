<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
'name', 'phone', 'address','identity'
];
/**
* The attributes that should be hidden for arrays.
*
* @var array
*/
protected $hidden = [
'password', 'remember_token',
];
/**
* The attributes that should be cast to native types.
*
* @var array
*/
protected $casts = [
'email_verified_at' => 'datetime',
'roles_name' => 'array',

];
static  public function getSingle($id)
{
    return self::find($id);
}
}
