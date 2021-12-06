<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\locale;
use App\Models\BrandType;
use App\Models\CancellationReasons;
use App\Models\CarModel;
use App\Models\City;
use App\Models\More;
use Illuminate\Http\Request;

class MoreController extends Controller
{
    public function getLocaleData($array)
    {
        $localeData = array();
        foreach ($array as $arr) {
            array_push($localeData, ['id' => $arr['id'], 'name' => $arr['name' . (app()->getLocale() == 'ar' ? '' : '_en')]]);
        }
        return $localeData;
    }

    public function getCities()
    {
        //  dd(app()->getLocale());
        $localCities = $this->getLocaleData(City::all());
        return response()->json(['all cities' => $localCities], 200);
    }

    public function getBrands()
    {
        $brands = $this->getLocaleData(BrandType::all());
        return response()->json(['BrandTypes' => $brands], 200);
    }
    public function getCancellationReasons()
    {

        $cancels = $this->getLocaleData(CancellationReasons::all());
        return response()->json(['cancelellation reasons' => $cancels], 200);
    }
    public function getCarModels()
    {

        $cars = $this->getLocaleData(CarModel::all());
        return response()->json(['Car models ' => $cars], 200);
    }


    public function getBanners()
    {
        $banners = More::whereNotNull('banners_pics')->get(['banners_pics', 'id']);
        if (!$banners->isEmpty()) {
            return response()->json(['banners' => $banners], 200);
        } else {

            return response()->json(['banners' => More::all(['banners_pics', 'id'])], 200);
        }
    }
    public function getCommession()
    {
        return response()->json(['commission' => More::all('commission', 'id')->first()], 200);
    }
    public function getHowToUse()
    {
        $locales = array();
        $arr = More::all('how_to_use', 'how_to_use_en', 'id')->first();
        array_push($locales, ['id' => $arr['id'], 'how_to_use' => $arr['how_to_use' . (app()->getLocale() == 'ar' ? '' : '_en')]]);
        return response()->json(['howToUse' => $locales], 200);
    }
    public function getWhoWeAre()
    {
        $locales = array();
        $arr = More::all('who_are_we', 'who_are_we_en', 'id')->first();
        array_push($locales, ['id' => $arr['id'], 'who_are_we' => $arr['who_are_we' . (app()->getLocale() == 'ar' ? '' : '_en')]]);
        return response()->json(['who we are' =>$locales], 200);
    }
}
