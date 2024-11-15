<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\GenderType;

class Users extends Model
{
  use SoftDeletes;
  protected $fillable = [
    'uid',
    'first_name',
    'last_name',
    'email',
    'password',
    'address',
    'phone',
    'phone_2',
    'postal_code',
    'birth_date',
    'gender',
  ];

  protected $casts = [ 'gender' => GenderType::class];
  
}
