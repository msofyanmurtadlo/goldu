<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Network;
use App\Models\Convertion;
use Illuminate\Http\Request;
use App\Helpers\SettingsHelper;
use App\Models\Bonus;
use Stevebauman\Location\Facades\Location;

class PostbackController extends Controller
{
    public function index(Request $request)
    {
        $settings = SettingsHelper::getAllSettings();
        $key = $request->input('key');
        $settingsKey = $settings['Postback_Key'];
        if ($key == $settingsKey) {
            $network = $request->input('network');
            $alias = Network::where('alias', $network)->first();
            if ($alias) {
                $id = $request->input('id');
                $user = User::where('username', $id)->first();
                if ($user) {
                    $country = $request->input('country');
                    if (strlen($country) == 2 && ctype_upper($country)) {
                        $country = $country;
                    } else {
                        $location = Location::get($country);
                        $getcountrycode = $location->countryCode;
                        $country = $getcountrycode;
                    }
                    $ballance = $request->input('ballance');
                    if ($user->custom_fee) {
                        $defaultFee = $user->fee;
                    } else {
                        $defaultFee = $settings['Default_Fee'];
                    }
                    $amountToDeduct = ($defaultFee / 100) * $ballance;
                    $ballance -= $amountToDeduct;
                    if ($user->referal != 'system') {
                        $referal = User::where('username', $user->referal)->first();
                        if ($referal) {
                            $percentageToReferal = 0.1;
                            $amountToReferal = $ballance * $percentageToReferal;
                            Bonus::create([
                                'from'  => $user->username,
                                'country' =>  $country,
                                'ballance' =>  $amountToReferal,  // Change here to reflect the bonus amount
                                'network_id' =>  $alias->id,
                                'user_id' => $referal->id
                            ]);
                            $ballance -= $amountToReferal;
                        }
                    }
                    Convertion::create([
                        'country' =>  $country,
                        'ballance' =>  $ballance,
                        'network_id' =>  $alias->id,
                        'user_id' => $user->id
                    ]);
                }
            }
        }
    }
}
