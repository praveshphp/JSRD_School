<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mark;
class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'entrance_no',
        'roll_no',
        'student_name',
        'father_name',
        'mother_name',
        'class',
        'section',
        'year',
        'updated_at'
    ];
    public function marks()
    {
        return $this->hasMany(Mark::class,'roll_no','roll_no');
    }
}
