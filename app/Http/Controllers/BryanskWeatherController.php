<?php

namespace App\Http\Controllers;

use App\Contracts\WeatherServiceInterface;
use Illuminate\Support\Facades\Log;

class BryanskWeatherController extends Controller
{
    public function showTemperature(WeatherServiceInterface $weatherService)
    {
        try {
            $temperature = $weatherService->getCurrentTemperatureByCityName('Bryansk');
            return view('bryansk-weather', [
                'temperature' => $temperature
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            abort('503');
        }
    }
}
