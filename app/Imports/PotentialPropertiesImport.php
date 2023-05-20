<?php

namespace App\Imports;

use App\Models\PotentialProperty;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PotentialPropertiesImport implements ToCollection, WithChunkReading, WithValidation, WithHeadingRow, WithCalculatedFormulas, SkipsEmptyRows
{
    private $region_id;
    public function  __construct($region_id)
    {
        $this->region_id = $region_id;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {
                PotentialProperty::updateOrCreate([
                    'region_id' => $this->region_id,
                    'address' => $row['address'],
                ], [
                    'region_id' => $this->region_id,
                    'address' => $row['address'],
                    'owner' => $row['owner'],
                    'owner_contact' => $row['owner_contact'],
                    'owner_mailing_address' => $row['owner_mailing_address'],
                    'tenant' => $row['tenant'],
                    'tenant_contact' => $row['tenant_contact'],
                    'acreage' => $row['acreage'],
                    'zoning' => $row['zoning'],
                    'google_link' => $row['google_link'],
                    'notes' => $row['notes'],
                    'sf' => $row['sf_based_on_appx_acreage'],
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
            'owner' => [],
            'owner_contact' => [],
            'owner_mailing_address' => [],
        ];
    }
}
