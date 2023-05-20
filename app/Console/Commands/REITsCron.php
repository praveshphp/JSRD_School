<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LatLng;
use App\Models\Reit;

class REITsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reits_google:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $potPro = Reit::select('id', 'property', 'address', 'address', 'city', 'state')->where('lat', '=', '')->orWhereNull('lat')->where('status', '=', 1)->limit(1)->get();
        foreach ($potPro as $pp) {
            try {

                $prepAddr = str_replace(' ', '+', $pp->property . " " . $pp->address . " " . $pp->address_2 . " " . $pp->city . " " . $pp->state);
                $latlng = LatLng::file_get_contents($prepAddr);

                $pp->id = $pp->id;
                if (!empty($latlng)) {
                    $pp->lat = $latlng['lat'];
                    $pp->lng = $latlng['lng'];
                } else {
                    $pp->status = 0;
                }
                $pp->save();
            } catch (\Throwable $th) {
            }
        }
        return 0;
    }
}
