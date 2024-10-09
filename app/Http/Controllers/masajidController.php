<?php

namespace App\Http\Controllers;

use App\Models\masajidModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\MasajidRequest;
use App\Models\profilesModel;
use Illuminate\Support\Facades\Auth;

class masajidController extends Controller
{
    
    //Display Masajid Database
    public function show() {

    return view('Masajid.masajid_database', ['masajid' => masajidModel::latest()
    ->filter(request(['search']))->paginate(10)
    ]);
}

//Display Masajid Registration Form
public function create() {

    return view('Masajid.masajid_reg_form');
}

    //Store Masajid Registration Information
public function store(MasajidRequest $request){ 
    
    $data = $request->validated();

    $masjid = masajidModel::create($data);
    return redirect('/masajid_database')->with('message', 'Masjid Added Successfully!');
}

// Show Single Masjid
public function view($id) {

    $profileId = profilesModel::where('user_id', Auth::user()->id)->first();

    $mosque = masajidModel::with('imam', 'muazzin', 'chairman')->find($id);

    $imam = $mosque->imam;
    $muazzin = $mosque->muazzin;
    $chairman = $mosque->chairman;

        if (Gate::allows('isAdmin')) {

    $masjid = $mosque;

        } elseif (($imam && $muazzin && $chairman) && ($imam->id == $id || $muazzin->id == $id || $chairman->id == $id)) {
            $masjid = $mosque
            ->where('imam_id', $id)
            ->orWhere('muazzin_id', $id)
            ->orWhere('chairman_id', $id)
            ->find($id);
        }
        else{
            abort(403, 'Unauthorized access.');
        }

    // $imam = $masjid->imam;
    // $muazzin = $masjid->muazzin;
    // $chairman = $masjid->chairman;

    return view('Masajid.single_masjid', compact('masjid', 'imam', 'muazzin', 'chairman'));
}


    // Show Edit Form
public function edit($id){

    $masjid = masajidModel::with('imam', 'muazzin', 'chairman')
    ->find($id);
    $imam = $masjid->imam;
    $muazzin = $masjid->muazzin;
    $chairman = $masjid->chairman;
    
    return view('Masajid.edit_masjid', compact('masjid', 'imam', 'muazzin', 'chairman'));
}


// Update Masjid
public function update(MasajidRequest $request, $id){

    $data = $request->validated();

    $masjid = masajidModel::where('id', $id)->update($data);
    return redirect('/masajid_database')->with('message', 'Masjid Data updated Successfully!');
}


// Delete Masjid
public function delete($id) {
    $masjid = masajidModel::where('id', $id)->delete();
    return redirect('/masajid_database')->with('message', 'Masjid Deleted Successfully!');
}

//Display Masajid Database for Profile
public function profileMasajid($id) {

    $masajidQuery = masajidModel::with(['imam', 'muazzin', 'chairman']);

    if (Gate::allows('isAdmin')) {

        $masajid = $masajidQuery
            ->latest()
            ->filter(request(['search']))
            ->paginate(10);
    } else {

        $masajid = $masajidQuery
            ->where('imam_id', $id)
            ->orWhere('muazzin_id', $id)
            ->orWhere('chairman_id', $id)
            ->latest()
            ->filter(request(['search']))
            ->paginate(10);
    }

    return view('Masajid.masajid_database', [
        'masajid' => $masajid
    ]);
}

}
