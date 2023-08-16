<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'gender', 'date_of_birth', 'address', 'phone_number', 'employee_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
