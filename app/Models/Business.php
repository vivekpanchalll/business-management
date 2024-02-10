<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone_number', 'logo'];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
