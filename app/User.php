<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable {
   //
   use AuthenticableTrait;

   protected $fillable = ['username', 'password'];
   protected $hidden = [
   'password'
   ];

   public $timestamps = false;
   /*
   * Get Todo of User
   *
   */
   public function authenticate()
   {
       return true;;
   }

}