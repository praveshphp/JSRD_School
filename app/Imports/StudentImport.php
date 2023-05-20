<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentImport implements ToCollection, WithChunkReading, WithValidation, WithHeadingRow, WithCalculatedFormulas, SkipsEmptyRows

{

    public function  __construct()
    {
    }
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {
                Student::updateOrCreate([
                    'roll_no' => $row['roll_no'],
                ], [

                    'entrance_no' => $row['entrance_no'],
                    'roll_no' => $row['roll_no'],
                    'student_name' => $row['student_name'],
                    'father_name' => $row['father_name'],
                    'mother_name' => $row['mother_name'],
                    'class' => $row['class'],
                    'section' => $row['section'],
                    'year' => $row['year']
                ]);
            }
        }
    }
    public function batchSize(): int
    {
        return 500;
    }
    public function chunkSize(): int
    {
        return 500;
    }
    public function rules(): array
    {
        return [

            'entrance_no' => [],
            'roll_no' => ['required'],
            'student_name' => ['required'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'class' => ['required'],
            'section' => [],
            'year' => ['required']
        ];
    }
}
