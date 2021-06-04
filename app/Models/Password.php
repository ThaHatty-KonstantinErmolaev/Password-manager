<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'value',
        'login',
        'tags',
        'description',
        'password_role_id',
    ];

    public function categories() {
        return $this->belongsToMany('\App\Models\PasswordCategory\PasswordCategory', 'category_password');
    }

    public function role() {
        return $this->hasOne('\App\Models\Role', 'id', 'password_role_id');
    }

}
