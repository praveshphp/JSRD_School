<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LatLng;
use App\Models\PointsOfInterest;

class PointsOfInterestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'points_of_interest:cron';

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
        $potPro = PointsOfInterest::select('id', 'address','city','state')->where('lat', '=', '')->orWhereNull('lat')->where('status','=',1)->limit(20)->get();
       
        foreach ($potPro as $pp) {  
            try {
				
                $prepAddr = str_replace(' ', '+', $pp->address." ".$pp->city.' '.$pp->state);
                $latlng = LatLng::file_get_contents($prepAddr);
               
                $pp->id = $pp->id;
				if(!empty($latlng)){
					$pp->lat = $latlng['lat'];
					$pp->lng = $latlng['lng'];
				}else{
					$pp->status = 0;
				}

                $pp->save();
            } catch (\Throwable $th) {
               
            }
        }

        return 0;
    }
}
