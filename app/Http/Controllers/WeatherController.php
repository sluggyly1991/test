<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Http;
 
class WeatherController extends Controller
{
    /**
     * Show the weather for a specific user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $contact = Contacts::find($id);

        $latLong = ContactsController::getLatLong($contact->street . " " . $contact->city . " " . $contact->country);
        

        return view('weather.single', [
            'contact' => $contact,
            'weather' => $this->getWeather($latLong['lat'], $latLong['long']),
            'contacts' => Contacts::all()
        ]);

    }

    /**
     * get weather data from api for specific location
     *
     * @param  float  $lat
     * @param  float  $long
     * @return array
     */
    public function getWeather($lat, $long) {
        try {
            $response = Http::get('https://api.weatherbit.io/v2.0/current?lang=de&key=' . env('WEATHERBIT_API_KEY'). '&lat=' . $lat . '&lon= ' . $long);
            return $response->json('data')[0];
        } catch (\Exception $e) {
            return array();
        }
    }
}