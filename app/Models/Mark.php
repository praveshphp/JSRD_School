<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'roll_no',
        'subjects',
        'half_yearly_max_marks',
        'half_yearly_obtained',
        'yearly_total_marks',
        'yearly_obtained_marks',
        'date',
        'updated_at'
    ];
    public function students()
    {
        return $this->belongsTo(Student::class, 'roll_no','roll_no');
    }
}
