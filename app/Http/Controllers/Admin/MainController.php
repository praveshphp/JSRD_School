<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reit;
use Illuminate\Support\Facades\URL;
use DB;
use Illuminate\Support\Facades\Route;
use App\Project44\Api;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function dashboard()
    {
       

        $reits = Reit::with('reit_companies')->where('status', '=', 1)->get();
        $reit_arr_un = [];
        $reit_un = 0;
        $reit_companies = [];
        $reit_i = 0;
        $reit_arr = [];
        foreach ($reits as $reit) {
            if ($reit->lat == "" || $reit->lat == "0") {
                $reit_arr_un[$reit_un] = $reit;
                $reit_un++;
            } else {
                $reit_companies[$reit->reit_companies->id] = $reit->reit_companies->company_name;
                $reit_arr[$reit_i]['id'] = $reit->id;
                $reit_arr[$reit_i]['lat'] = $reit->lat;
                $reit_arr[$reit_i]['lng'] = $reit->lng;
                $reit_arr[$reit_i]['reit_companies'] = $reit->reit_companies->id;
                $reit_arr[$reit_i]['icon'] = URL::asset('images/map/reits.svg');
               
                $datt = '<div class="card-bx stacked card c-black" style="background:#000;color:#fff">                
            <div class="card-info">';
                $datt .= (!empty($reit->reit_companies->company_name)) ? '<p class="mb-3 text-center text-white fs-22">Company: ' . $reit->reit_companies->company_name . '</p>' : "";

                $datt .= '<div class="row fs-14">';
                $datt .= (!empty($reit->property)) ? '<div class="col-6"><b>Property Name</b>: ' . $reit->property . '</div>' : "";
                $datt .= (!empty($reit->address)) ? '<div class="col-6"><b>Address</b>: ' . $reit->address . " " . $reit->address2 . '</div>' : "";
                $datt .= (!empty($reit->city)) ? '<div class="col-6"><b>City</b>: ' . $reit->city . '</div>' : "";
                $datt .= (!empty($reit->state)) ? '<div class="col-6"><b>State</b>: ' . $reit->state . '</div>' : "";
                $datt .= (!empty($reit->zip)) ? '<div class="col-6"><b>ZIP</b>: ' . $reit->zip . '</div>' : "";
                $datt .= (!empty($reit->size)) ? '<div class="col-6"><b>SIZE</b>: ' . $reit->size . '</div>' : "";
                $datt .= (!empty($reit->market)) ? '<div class="col-6"><b>Market</b>: ' . $reit->market . '</div>' : "";
                $datt .= (!empty($reit->number_of_buildings)) ? '<div class="col-6"><b># of buildings</b>: ' . $reit->number_of_buildings . '</div>' : "";
                $datt .= (!empty($reit->acquistion_date)) ? '<div class="col-6"><b>Acquistion Date</b>: ' . $reit->acquistion_date . '</div>' : "";
                $datt .= (!empty($reit->office_size)) ? '<div class="col-6"><b>Office Size</b>: ' . $reit->office_size . '</div>' : "";
                $datt .= (!empty($reit->land_size)) ? '<div class="col-6"><b>Land Size</b>: ' . $reit->land_size . '</div>' : "";
                $datt .= (!empty($reit->ownership)) ? '<div class="col-6"><b>Ownership</b>: ' . $reit->ownership . '</div>' : "";
                $datt .= (!empty($reit->purchase_price)) ? '<div class="col-6"><b>Purchase Price</b>: ' . $reit->purchase_price . '</div>' : "";
                $datt .= '
                </div>                
                <div class="row position-relative " style="bottom: -19px;z-index:9999">
                <div class="col-xl-6 text-left text-white"><a href="' . route('reits.edit', $reit->id) . '"  class="text-white">Edit</a></div>
                
                </div>
            </div>
            <p class="btn-caret-map m-0 p-0"><i class="fa fa-caret-down" aria-hidden="true"></i></p>
        </div>';
                $reit_arr[$reit_i]['pop'] = $datt;
                $reit_i++;
            }
            $datt = "";
        }


        

        return view('admin.home', compact(            
            'reit_arr',
            'reit_arr_un',            
            'reit_companies',
        ));
    }
    function population(Request $request)
    {
        $diff = 10000;
        if (request()->ajax()) {
            $offset = $request->get('offset');
            if ($offset == '') {
                $offset = 0;
            }
            $pcities = DB::table('population_cities')->select('zip', 'lat', 'lng', 'city', 'population', 'state_name', 'density')->limit($diff)->offset($offset)->get();

            if (count($pcities) > 0) {
                $arr = [];
                foreach ($pcities as $key => $value) {
                    $arr[$key] = (array) $value;
                    $datt = '<div class="card-bx stacked card c-purple">               
                <div class="card-info" style="background: #6747C0;">
                    <p class="mb-1 text-white fs-14">' . $value->city . ', ' . $value->state_name . ', ' . $value->zip  . '</p>
                    <div class="d-flex justify-content-between">
                        <h2 class="num-text text-white mb-5 font-w600">
                        <p class="fs-12 mb-1 op6">DENSITY</p>
                        <span>' . $value->density . '</span><p class="fs-12 mb-1 op6">POPULATION</p>
                        <span>' . $value->population . '</span></h2>
                   
                    </div>
                    <div class="d-flex">
                        <div class="me-4 text-white">
                            <p class="fs-12 mb-1 op6">Latitude</p>                        
                            <span>' . $value->lat  . '</span><br>
                        </div>
                        <div class="text-white">
                            <p class="fs-12 mb-1 op6">Logitude</p>
                            <span>' . $value->lng . '</span><br>
                        </div>
                    </div>
                    <div class="row position-relative " style="bottom: -19px;z-index:9999">
                    </div>
                </div>
                <p class="btn-caret-map m-0 p-0"><i class="fa fa-caret-down" aria-hidden="true"></i></p>
            </div>';
                    $arr[$key]['pop'] = $datt;
                    $arr[$key]['icon'] =  URL::asset('images/map/population.svg');;
                }
                $result = ['pcities' => $arr, 'next' => $offset + $diff];
            } else {
                $result = ['status' => 'ZERO_RESULTS'];
            }
            return Response()->json($result);
        }
    }
    function population_radius(Request $request)
    {
        $diff = 10;
        if (request()->ajax()) {
            $data = $request->all();
            //print_R($data);exit;
            $total_population = DB::Raw('SUM(population) as total_population');
            //$pcities = DB::table('population_cities')->select($total_population)->first();

            $pcities = DB::table("population_cities")
                ->select(
                    "population_cities.id",
                    "population_cities.population",
                    'population_cities.lat',
                    'population_cities.lng',
                    \DB::raw("3959 * acos(cos(radians(" . $data['lat'] . ")) * cos(radians(population_cities.lat)) 
                * cos(radians(population_cities.lng) - radians(" .  $data['lng'] . ")) 
                + sin(radians(" . $data['lat'] . ")) 
                * sin(radians(population_cities.lat ))) AS distance")
                )->having('distance', '<', $data['radius'])
                ->get();
            $population = 0;
            foreach ($pcities as $p) {
                $population += $p->population;
            }
            if ($population !== 0) {
                $datt = '<div class="card-bx stacked card c-blue">
            <img src="' . URL::asset('images/card/card3.jpg') . '" alt="">
            <div class="card-info">                
                <div class="d-flex justify-content-between">
                    <h2 class="num-text text-white mb-5 font-w600">
                    <span>Total Population: ' . (number_format($population)) . '</span></h2>
                </div>
            </div>
            <p class="btn-caret-map m-0 p-0"><i class="fa fa-caret-down" aria-hidden="true"></i></p>
        </div>';

                $result = ['population' => $datt];
            } else {
                $result = ['population' => 0];
            }

            return Response()->json($result);
        }
    }
    function search_zip(Request $request)
    {

        if (request()->ajax()) {
            $data = $request->all();
           
            $value = DB::table("population_cities")
                ->select(
                    "population_cities.*"
                )->where('zip', '=', $data['zip'])
                ->first();           
            
            if ($value) {
                $datt = '<div class="card-bx stacked card c-purple">               
                <div class="card-info" style="background: #6747C0;">
                    <p class="mb-1 text-white fs-14">' . $value->city . ', ' . $value->state_name . ', ' . $value->zip  . '</p>
                    <div class="d-flex justify-content-between">
                        <h2 class="num-text text-white mb-5 font-w600">
                        <p class="fs-12 mb-1 op6">DENSITY</p>
                        <span>' . $value->density . '</span><p class="fs-12 mb-1 op6">POPULATION</p>
                        <span>' . $value->population . '</span></h2>
                   
                    </div>
                    <div class="d-flex">
                        <div class="me-4 text-white">
                            <p class="fs-12 mb-1 op6">Latitude</p>                        
                            <span>' . $value->lat  . '</span><br>
                        </div>
                        <div class="text-white">
                            <p class="fs-12 mb-1 op6">Logitude</p>
                            <span>' . $value->lng . '</span><br>
                        </div>
                    </div>
                    <div class="row position-relative " style="bottom: -19px;z-index:9999">
                    </div>
                </div>
                <p class="btn-caret-map m-0 p-0"><i class="fa fa-caret-down" aria-hidden="true"></i></p>
            </div>';
                $result = ['status' => 'success', 'zip' => $data['zip'], 'pop' => $datt];
            } else {
                $result = ['status' => 'error', 'message' => 'No Zipcode Found!'];
            }


            return Response()->json($result);
        }
    }
    public function autocomplete(Request $request)
    {
        $keyword = $request->get('search');
        $p1 = DB::table('potential_properties')
            ->where('address', 'LIKE', '%' . $request->get('search') . '%')
            ->select("address", "id", DB::raw("'Potential Property' AS `ptype`"));

        $p2 = DB::table('competitor_properties')
            ->where('address', 'LIKE', '%' . $request->get('search') . '%')
            ->select("address", "id", DB::raw("'Competitor Property' AS `ptype`"));

        $p3 = DB::table('points_of_interests')
            ->where('address', 'LIKE', '%' . $request->get('search') . '%')
            ->select("id", "address", DB::raw("'Points Of Interests' AS `ptype`"));

        $p = $p1->unionAll($p2);

        $result = DB::table(DB::raw("({$p->toSql()}) AS p"))
            ->mergeBindings($p)
            ->union($p3)
            ->select('id', 'address', 'ptype')->orderBy('address')->offset(0)->limit(10)->get();

        // $potential_properties = PotentialProperty::with('regions')->get();

        // $data = PotentialProperty::select("address", "id", DB::raw("'Potential Property' AS `ptype`"))
        //     ->where('address', 'LIKE', '%' . $request->get('search') . '%')
        //     ->get();

        return response()->json($result);
    }
}
