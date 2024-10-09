<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profilesModel;
use App\Models\marriagesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\profilesRequest;

class profilesController extends Controller
{
    //Display Profiles Database
    public function show() {

        return view('Profiles.profiles_database', ['profiles' => profilesModel::latest()
        ->filter(request(['search']))->paginate(10)
        ]);
    }

    //Display Profile Registration Form
    public function create() {

        $userId = Auth::user()->id;

        return view('Profiles.profiles_reg_form', ['userId' => $userId]);
    }

    //Store Profile Registration Information
public function store(profilesRequest $request){ 
    
    $data = $request->validated();

    $profile = profilesModel::create($data);

    if(Gate::allows('isAdmin')) {
    return redirect('/profiles_database')->with('message', 'Profile created Successfully!');
}

return redirect('/dashboard')->with('message', 'Profile created Successfully!');

}

// Show Single Profile
public function view($id) {
    $husband = profilesModel::with('husbandMarriages')
    ->with('users')
    ->find($id);

    $wife = profilesModel::with('wifeMarriages')
    ->with('users')
    ->find($id);

    $marriages = marriagesModel::query()
        ->when($husband, function ($query) use ($husband) {

            return $query->where('husband_id', $husband->id);
        })
        ->when($wife, function ($query) use ($wife) {

            return $query->orWhere('wife_id', $wife->id);
        })
        ->get();

    $profile = profilesModel::with('users')
    ->find($id);

    $userProfile = profilesModel::where('user_id', Auth::user()->id)->first();

    $users = $profile->users;
    $husbandmarriages = $husband->husbandMarriages;            
    $wifemarriages = $wife->wifeMarriages;

    if(Gate::allows('isAdmin') || $userProfile->id == $id) {
    return view('profiles.single_profile', compact('profile', 'husbandmarriages', 'wifemarriages', 'users', 'marriages'));
    }
    else{
        abort(403, 'Unauthorized access.');
    }
}


// Show Edit Form
public function edit($id){

$profile = profilesModel::find($id);
return view('Profiles.edit_profile', compact('profile'));
}


// Update Profle Data
public function update(profilesRequest $request, $id){

$data = $request->validated();

$profile = profilesModel::where('id', $id)->update($data);
return redirect('/profiles_database')->with('message', 'Profile Data updated Successfully!');
}


// Delete Profile
public function delete($id) {
$husband = profilesModel::where('id', $id)->delete();
return redirect('/profiles_database')->with('message', 'Profile Deleted Successfully!');
}

}
