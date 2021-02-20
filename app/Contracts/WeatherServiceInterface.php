<?php


namespace App\Contracts;


interface WeatherServiceInterface
{
    public function getCurrentTemperatureByCityName(string $cityName) : int;
}
