<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class WeatherApiController extends Controller
{
    public function index(){

        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] = "List of products";

        return view('api.index')-> with("viewData", $viewData);
    }
    public function search(Request $request)
    {
        $city = $request->input("city") ;
        $key = config('services.owm.key');
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q=".$city."&lang=en"."&appid=".$key)->json();
         if($response['cod'] != "200")
        {
            $notFound = true;
            $viewData["notFound"] = $notFound;
            return view('api.index')->with("viewData", $viewData);
        }else{
            $viewData = [];
            $weather = $response['weather'][0]['description'];
            $main = $response['weather'][0]['main'];
            $temp = $response['main']['temp'] - 273;
            $name = $response['name'];
            $country = $response['sys']['country'];
            $ok = $response['cod'];

            $viewData["title"] = "Home Page - Online Store";
            $viewData["weather"] = $weather;
            $viewData["main"] = $main;
            $viewData["temp"] = $temp;
            $viewData["name"] = $name;
            $viewData["country"] = $country;
            $viewData["ok"] = $ok;      
            return view('api.index')->with("viewData", $viewData);
        }
    }
}