<?php

namespace App\Imports;

use App\Models\PopulationCity;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PopulationCityImport implements ToCollection, WithChunkReading, WithValidation, WithHeadingRow, WithCalculatedFormulas, SkipsEmptyRows
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {
                PopulationCity::updateOrCreate([
                    'zip' => $row['zip'],
                ], [
                    'zip' => $row['zip'],
                    'lat' => $row['lat'],
                    'lng' => $row['lng'],
                    'city' => $row['city'],
                    'state_id' => $row['state_id'],
                    'state_name' => $row['state_name'],
                    'zcta' => $row['zcta'],
                    'parent_zcta' => $row['parent_zcta'],
                    'population' => $row['population'],
                    'density' => $row['density'],
                    'county_fips' => $row['county_fips'],
                    'county_name' => $row['county_name'],
                    'county_weights' => $row['county_weights'],
                    'county_names_all' => $row['county_names_all'],
                    'county_fips_all' => $row['county_fips_all'],
                    'imprecise' => $row['imprecise'],
                    'military' => $row['military'],
                    'timezone' => $row['timezone'],
                ]);
            }
        }
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
    public function rules(): array
    {
        return [

            'zip' => [
                'required',
            ],
            'lng' => [],
            'lat' => [],
            'city' => [],
        ];
    }
}
