<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploymentInformation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'job_title', 'department', 'date_of_joining', 'employment_status', 'work_location', 'base_salary', 'bonuses', 'allowances'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
