<?php

namespace App\Imports;

use App\Models\CompetitorProperty;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class CompetitorPropertiesImport implements ToCollection, WithChunkReading, WithValidation, WithHeadingRow, WithCalculatedFormulas, SkipsEmptyRows
{
    private $competitor_id;
    public function  __construct($competitor_id)
    {
        $this->competitor_id = $competitor_id;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {
                CompetitorProperty::updateOrCreate([
                    'competitor_id' => $this->competitor_id,
                    'address' => $row['address'],
                ], [
                    'competitor_id' => $this->competitor_id,
                    'address' => $row['address'],
                    'size' => $row['size'],
                    'description' => isset($row['description']) ? $row['description'] : '',
                    'notes' => isset($row['notes']) ? $row['notes'] : '',
                    'ideal_uses' => isset($row['ideal_uses']) ? $row['ideal_uses'] : '',
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

            'address' => [],
            'size' => [],
            'description' => [],
            'notes' => [],
            'ideal_uses' => [],
        ];
    }
}
