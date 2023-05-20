<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LatLng;
use App\Models\CompetitorProperty;

class CompetitorPropertyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competitor_property_google:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Lat & Lng from google';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $potPro = CompetitorProperty::select('id', 'address')->where('lat', '=', '')->orWhereNull('lat')->limit(25)->get();
        foreach ($potPro as $pp) {
            $prepAddr = str_replace(' ', '+', $pp->address);
            $latlng = LatLng::file_get_contents($prepAddr);
            if ($latlng) {
                $pp->id = $pp->id;
                $pp->lat = $latlng['lat'];
                $pp->lng = $latlng['lng'];
                $pp->save();
            }
        }

        return 0;
    }
}
