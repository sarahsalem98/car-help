<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BrandType;
use App\Models\CancellationReasons;
use App\Models\CarModel;
use App\Models\City;
use App\Models\More;
use Illuminate\Http\Request;

class MoreController extends Controller
{

    public function getCities(){
        //  dd(app()->getLocale());
          $cities=City::all('id','name'.(app()->getLocale()=='ar'?'':'_en'));
          return response()->json(['all cities'=>$cities],200);
        }

        public function getBrands(){
            $brands=BrandType::all('id','name'.(app()->getLocale()=='ar'?'':'_en'));
            return response()->json(['BrandTypes'=>$brands],200);
        }
        public function getCancellationReasons(){
            $cancels=CancellationReasons::all('id','name'.(app()->getLocale()=='ar'?'':'_en'));
            return response()->json(['cancelellation reasons'=>$cancels],200);
        }
        public function getCarModels(){
            $cars=CarModel::all('id','name'.(app()->getLocale()=='ar'?'':'_en'));
            return response()->json(['Car models '=>$cars],200);
        }
    

        public function getBanners(){
            $banners=More::whereNotNull('banners_pics')->get(['banners_pics','id']);
            if(!$banners->isEmpty()){
                return response()->json(['banners'=>$banners],200);
            }else{
        
                return response()->json(['banners'=>More::all(['banners_pics','id'])],200);
            }
        }
        public function getCommession(){
            return response()->json(['commission' => More::all('commission', 'id')->first()],200);
        }
        public function getHowToUse(){
            return response()->json( ['howToUse' => More::all('how_to_use', 'id')->first()],200);
        }
        public function getWhoWeAre(){
            return response()->json( ['who we are' => More::all('who_are_we', 'id')->first()],200);

        }

}
