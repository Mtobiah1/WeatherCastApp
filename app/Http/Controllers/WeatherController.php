<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use Illuminate\Support\Facades\Auth;
use App\Models\SearchHistory;
class WeatherController extends Controller
{

    
    private $apiKey = '692a56e845994196afbb5412fde1a3fd';

    public function getCurrentWeather(Request $request)
    {
        $city = $request->input('city');
        $country = $request->input('country');
        
        // Fetch current weather
        $response = Http::get("https://api.weatherbit.io/v2.0/current", [
            'city' => $city,
            'country' => $country,
            'key' => $this->apiKey
        ]);

        // Store search in history
        SearchHistory::create([
            'city_name' => $city,
            'country_code' => $country,
            'user_id'=>Auth::id()
        ]);

        $weather = $response->json();

        return response()->json($weather);
    }

    public function get16DayForecast(Request $request)
    {
        $city = $request->input('city');
        $country = $request->input('country');

        // Fetch 16-day weather forecast
        $response = Http::get("https://api.weatherbit.io/v2.0/forecast/daily", [
            'city' => $city,
            'country' => $country,
            'key' => $this->apiKey
        ]);

        $forecast = $response->json();

        return response()->json($forecast);
    }

    public function getSearchHistory()
    {
        $history = SearchHistory::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        return response()->json($history);
    }
}
