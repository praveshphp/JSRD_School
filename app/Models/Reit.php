<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReitCompany;

class Reit extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'reit_company_id',
        'property',
        'address',
        'address_2',
        'state',
        'city',
        'zip',
        'size',
        'market',
        'number_of_buildings',
        'acquistion_date',
        'office_size',
        'land_size',
        'ownership',
        'purchase_price',
        'lat',
        'lng',
        'updated_at'
    ];
    public function reit_companies()
    {
        return $this->belongsTo(ReitCompany::class, 'reit_company_id');
    }
}
