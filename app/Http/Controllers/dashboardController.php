<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\husbandsModel;
use App\Models\masajidModel;
use App\Models\profilesModel;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    //Show Dashboard after Authentication
    public function show() {

        $profile = profilesModel::where('user_id', Auth::user()->id)->first();

        // $user = User::where('id', Auth::user()->id)->first();
        $user = Auth::user();

        if($profile) {

        $notifications = $profile->unreadNotifications;
    
        $husbandMarriages = $profile->husbandMarriages;

        $wifeMarriages = $profile->wifeMarriages;

        $masajid = masajidModel::where('imam_id', $profile->id)
        ->orWhere('muazzin_id', $profile->id)
        ->orWhere('chairman_id', $profile->id)
        ->get();
        

        return view('dashboard', [
            'user' => $user,
            'profile' => $profile,
            'husbandMarriages' => $husbandMarriages,
            'wifeMarriages' => $wifeMarriages,
            'masajid' => $masajid,
            'notifications' => $notifications,
        ]);
    }

    return view('dashboard', [
        'user' => $user,
        'profile' => $profile,
    ]);

    }
}
