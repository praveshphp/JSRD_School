<?php

namespace App\Imports;

use App\Models\Reit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ReitsImport implements ToCollection, WithChunkReading, WithValidation, WithHeadingRow, WithCalculatedFormulas, SkipsEmptyRows
{
    private $reit_company_id;
    public function  __construct($reit_company_id)
    {
        $this->reit_company_id = $reit_company_id;
    }
    public function collection(Collection $rows)
    {
          
        foreach ($rows as $row) {                
            if ($row->filter()->isNotEmpty()) {
                Reit::create( [
                    'reit_company_id' => $this->reit_company_id,
                    'property' => $row['property'],
                    'address' => $row['address'],
                    'address_2' =>  isset($row['address_2']) ? $row['address_2'] : null,
                    'city' =>  isset($row['city']) ? $row['city'] : null,
                    'zip' =>  isset($row['zip']) ? $row['zip'] : null,
                    'state' =>  isset($row['state']) ? $row['state'] : null,
                    'size' =>  isset($row['size']) ? $row['size'] : null,
                    'type' =>  isset($row['type']) ? $row['type'] : null,
                    'market' =>  isset($row['market']) ? $row['market'] : null,
                    'number_of_buildings' =>  isset($row['number_of_buildings']) ? $row['number_of_buildings'] : null,
                    'acquistion_date' =>  isset($row['acquistion_date']) ? $row['acquistion_date'] : null,
                    'office_size' =>  isset($row['office_size']) ? $row['office_size'] : null,
                    'land_size' =>  isset($row['land_size']) ? $row['land_size'] : null,
                    'ownership' =>  isset($row['ownership']) ? $row['ownership'] : null,
                    'purchase_price' =>  isset($row['purchase_price']) ? $row['purchase_price'] : null,
                    'lat' => isset($row['latitude']) ? $row['latitude'] : null,
                    'lng' => isset($row['longitude']) ? $row['longitude'] : null,
                ]);
            }
        }
    }
    public function batchSize(): int
    {        return 500;
    }
    public function chunkSize(): int
    {        return 500;
    }
    public function rules(): array
    {
        return [

            'address' => [ ],
            'property' => [],
            'address_2' => [],
            'city' => [],
            'zip' => [],
            'state' => [],
            'size' => [],
            'type' => [],
            'market' => [],
            'number_of_buildings' => [],
            'acquistion_date' => [],
            'office_size' => [],
            'land_size' => [],
            'ownership' => [],
            'purchase_price' => [],
            'Longitude' => [],
            'store_number' => [],
        ];
    }
}
