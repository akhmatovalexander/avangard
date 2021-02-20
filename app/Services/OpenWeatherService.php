<?php


namespace App\Services;

use App\Contracts\WeatherServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class OpenWeatherService implements WeatherServiceInterface
{
    private $httpClient;

    private $apiKey;

    /**
     * WeatherService constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client(['base_uri' => 'http://api.openweathermap.org/data/2.5/']);
        $this->apiKey = config('services.open_weather.key');
    }


    /**
     * @param  string  $cityName
     * @return int
     * @throws GuzzleException
     */
    public function getCurrentTemperatureByCityName(string $cityName) : int
    {
        return Cache::remember("{$cityName}-temperature", 1, function () use ($cityName) {
            $response = $this->httpClient->request(
                'GET',
                "weather?q={$cityName}&units=metric&appid={$this->apiKey}"
            );
            $body = json_decode($response->getBody());
            return $body->main->temp;
        });
    }
}
