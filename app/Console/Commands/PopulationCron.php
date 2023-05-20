<?php

namespace App\Console\Commands;

use App\Models\Population;
use Illuminate\Console\Command;

class PopulationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populations:cron';

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
        $populations = $this->file_get_population();
        if ($populations) {
            foreach ($populations as $key => $population) {
                if ($key != 0) {
                    Population::updateOrCreate([
                        'name' => $population[4],
                        'state' => (string) $population[5],
                    ], [
                        'geo_id' => $population[0],
                        'pop_2021' => $population[1],
                        'desc_pop_2021' => $population[2],
                        'rank_pop_2021' => $population[3],
                        'name' => $population[4],
                        'state' => $population[5],
                    ]);
                }
            }
        }
        return 0;
    }

    public static function file_get_population()
    {

        try {

            $url = 'https://api.census.gov/data/2021/pep/population?get=GEO_ID,POP_2021,DESC_POP_2021,RANK_POP_2021,NAME&for=state:*&key=1f116bbd03644a59249dd1c74ea388433570bccf';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $jsonData = curl_exec($ch);
            curl_close($ch);
            // $jsonData = $this->file_get_contents();
            $output = json_decode($jsonData);
            if (!empty($output)) {
                return $output;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
