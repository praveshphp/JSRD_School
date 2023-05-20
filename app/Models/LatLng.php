<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatLng extends Model
{
    use HasFactory;

    public static function file_get_contents($prepAddr)
    {    
        $key = config('app.google_map_key'); 
        try {
           
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&key=' . $key;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_REFERER, "54.151.42.37");
            $jsonData = curl_exec($ch);
            curl_close($ch);
            // $jsonData = $this->file_get_contents();
            $output = json_decode($jsonData);
            print_R($jsonData);exit;
            $latlng = [];
            if (isset($output->results[0]->geometry->location->lat)) {
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
                $latlng['lat'] = $latitude;
                $latlng['lng'] = $longitude;
            }
            return $latlng;
        } catch (\Exception $e) {
            print_R($e);exit;
            return false;
        }

    }
}
