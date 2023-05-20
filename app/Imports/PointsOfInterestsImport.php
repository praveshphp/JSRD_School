<?php

namespace App\Imports;

use App\Models\PointsOfInterest;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PointsOfInterestsImport implements ToCollection, WithChunkReading, WithValidation, WithHeadingRow, WithCalculatedFormulas, SkipsEmptyRows
{
    private $poi_company_id;
    public function  __construct($poi_company_id)
    {
        $this->poi_company_id = $poi_company_id;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {


        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {           
                PointsOfInterest::updateOrCreate([
                    //Add unique field combo to match here
                    //For example, perhaps you only want one entry per user:
                    'poi_company_id' => $this->poi_company_id,
                    'id_poi' => $row['store_number'],
                ], [
                    'poi_company_id' => $this->poi_company_id,
                    'address' => $row['address'],
                    'state' => $row['state'],
                    'city' => $row['city'],
                    'id_poi' => $row['store_number'],
                    'location' => $row['location'],
                    'zip_code' => $row['zip_code'],
                    'phone_number' => $row['phone_number'],
                    'store_website' => $row['store_website'],
                    'lat' => isset($row['latitude']) ? $row['latitude'] : null,
                    'lng' => isset($row['longitude']) ? $row['longitude'] : null,
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

            'address' => [
                'required',
                'string',
            ],
            'state' => [],
            'city' => [],
            'id_poi' => [],
            'location' => [],
            'zip_code' => [],
            'phone_number' => [],
            'store_website' => [],
            'latitude' => [],
            'Longitude' => [],
            'store_number' => [],
        ];
    }
}
