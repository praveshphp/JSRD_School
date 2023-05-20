<?php

namespace App\Imports;

use App\Models\Mark;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MarkImport implements ToCollection, WithChunkReading, WithValidation, WithHeadingRow, WithCalculatedFormulas, SkipsEmptyRows
{
    public function  __construct()
    {
    }
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {
                $student = Student::where('roll_no', '=', $row['roll_no'])->first();
                if ($student) {
                    Mark::updateOrCreate([
                        'roll_no' => $row['roll_no'],
                        'subjects' => $row['subjects'],
                    ], [

                        'roll_no' => $row['roll_no'],
                        'subjects' => $row['subjects'],
                        'half_yearly_max_marks' => $row['half_yearly_max_marks'],
                        'half_yearly_obtained' => $row['half_yearly_obtained'],
                        'yearly_total_marks' => $row['yearly_total_marks'],
                        'yearly_obtained_marks' => $row['yearly_obtained_marks'],
                        'date' => $row['date']
                    ]);
                }
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
            'roll_no' => ['required'],
            'subjects' => ['required'],
            'half_yearly_max_marks' => ['required'],
            'half_yearly_obtained' => ['required'],
            'yearly_total_marks' => ['required'],
            'yearly_obtained_marks' => [],
            'date' => ['required']
        ];
    }
}
