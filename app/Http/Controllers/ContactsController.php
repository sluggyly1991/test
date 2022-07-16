<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use App\Models\Contacts;
use Aws\LocationService\LocationServiceClient;

class ContactsController extends Controller
{
    /**
     * Add Contact to Database
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addUser()
    {

        $contact = new Contacts();
        $data = $this->getData("de");
        foreach ($this->getFields() as $field => $label) {
            $contact->{$field} = $data[$field];
        }
        $contact->save();

        return Redirect::route('contacts.show');
    }


    /**
     * Show all Contacts
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {

        return view('contacts.overview', [
            'fields' => $this->getFields(),
            'contacts' => Contacts::all()
        ]);
    }

    /**
     * Get Data for new User from API
     *
     * @param  String  $nat
     * @return array
     */
    private function getData($nat = '')
    {
        try {
            $response = Http::get('https://randomuser.me/api/?nat=' . $nat);
            $data =
                [
                    'contact_name' => $response->json('results')[0]['name']['first'] . ' ' . $response->json('results')[0]['name']['last'],
                    'email' => $response->json('results')[0]['email'],
                    'username' => $response->json('results')[0]['login']['username'],
                    'street' => $response->json('results')[0]['location']['street']['name'],
                    'number' => $response->json('results')[0]['location']['street']['number'],
                    'postcode' => $response->json('results')[0]['location']['postcode'],
                    'city' => $response->json('results')[0]['location']['city'],
                    'country' => $response->json('results')[0]['location']['country'],

                ];



            return $data;
        } catch (\Exception $e) {
            return array();
        }
    }

    
    /**
     * Get Location Details (lat, long) from AWS Service
     *
     * @param  String  $adress
     * @return array
     */
    public static function getLatLong($adress)
    {

        try {
            $client = new LocationServiceClient([
                'version' => 'latest',
                'region' => 'eu-central-1',
                'credentials' => [
                    'key'    => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);
            $res = $client->searchPlaceIndexForText([
                'IndexName' => 'explore.place',
                'Language' => 'de',
                'Text' => $adress
            ]);
        } catch (\Exception $e) {
            return array();
        }


        return array('lat' => $res['Results'][0]['Place']['Geometry']['Point'][1], 'long' => $res['Results'][0]['Place']['Geometry']['Point'][0]);
    }


    /**
     * Get Userfields
     *
     * @return array
     */
    private function getFields()
    {
        return  [
            'username' => 'Benutzername', 'contact_name' => 'Name', 'email' => 'Email', 'street' => 'Straße', 'number' => 'Nummer', 'postcode' => 'PLZ', 'city' => 'Stadt', 'country' => 'Land'
        ];
    }
}
