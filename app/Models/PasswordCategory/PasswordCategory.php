<?php

namespace App\Models\PasswordCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'password_id',
    ];

    public function passwords() {
        return $this->belongsToMany('\App\Models\Password', 'category_password');
    }

}
