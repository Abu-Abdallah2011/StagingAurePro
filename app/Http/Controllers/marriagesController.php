<?php

namespace App\Http\Controllers;

use App\Models\masajidModel;
use Illuminate\Http\Request;
use App\Models\profilesModel;
use App\Models\marriagesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\marriagesRequest;
use App\Notifications\MarriageRegisteredNotification;

class marriagesController extends Controller
{

    //Display Marriage Database
    public function show() {

    $user = auth()->user();

    $marriagesQuery = marriagesModel::with(['husband', 'wife', 'wakil', 'waliyy']);

    if (Gate::allows('isAdmin')) {

        $marriages = $marriagesQuery
            ->latest()
            ->filter(request(['search']))
            ->paginate(10);
    } else {

        $marriages = $marriagesQuery
            ->where('husband_id', $user->profile->id)
            ->orWhere('wife_id', $user->profile->id)
            ->orWhere('waliyy_id', $user->profile->id)
            ->orWhere('wakil_id', $user->profile->id)
            ->latest()
            ->filter(request(['search']))
            ->paginate(10);
    }

    return view('Marriages.marriages_database', [
        'marriages' => $marriages
    ]);

}
        
    //Display Marriage Registration Form
    public function create() {
        $profile = profilesModel::where('user_id', Auth::user()->id)->first();

        $husbandMarriages = $profile->husbandMarriages;

        $wifeMarriages = $profile->wifeMarriages;

        $masajid = masajidModel::get();

        if((Gate::allows('isAdmin')) || ($profile->gender === 'MALE' && $husbandMarriages->where('active', true)->count() < 4)) {
        return view('Marriages.marriages_reg_form', [
            'masajid' => $masajid
        ]);
        }
        
        elseif((Gate::allows('isAdmin')) || ($profile->gender === 'FEMALE' && $wifeMarriages->where('active', true)->count() < 1)){
            return view('Marriages.marriages_reg_form', [
                'masajid' => $masajid
            ]);
        }
        else{
            abort(403, 'Dear User, You have already reached the Maximum Number of Marriages permitted by Islam.');
        }
    }

    //Store Marriage Registration Information
public function store(marriagesRequest $request){ 
    
    $data = $request->validated();

    $husbandProfile = profilesModel::find($request->input('husband_id'));
    $wifeProfile = profilesModel::find($request->input('wife_id'));
    $waliyyProfile = profilesModel::find($request->input('waliyy_id'));
    $wakilProfile = profilesModel::find($request->input('wakil_id'));
    $date = $request->input('date');
    $time = $request->input('time');
    $venue = $request->input('venue');
    $dowry = $request->input('dowry');
    $dowry_status = $request->input('dowry_status');
    $venue_id = $request->input('venue_id');
    $husband_test = $request->file('husband_test');
    $wife_test = $request->file('wife_test');

    // Check husband requirements
    if ($husbandProfile->gender !== 'MALE') {
        return redirect()->back()->withErrors(['husband_id' => 'The husband must be male.']);
    }

    if ($husbandProfile->husbandMarriages()->where('active', true)->count() >= 4) {
        return redirect()->back()->withErrors(['husband_id' => 'The husband already has the maximum number of active marriages (4).']);
    }

    // Check wife requirements
    if ($wifeProfile->gender !== 'FEMALE') {
        return redirect()->back()->withErrors(['wife_id' => 'The wife must be female.']);
    }

    if (marriagesModel::where('wife_id', $wifeProfile->id)->where('active', true)->exists()) {
        return redirect()->back()->withErrors(['wife_id' => 'This wife is already registered in the system for another marriage.']);
    }

    // Check waliyy and wakil requirements
    if ($waliyyProfile->gender !== 'MALE') {
        return redirect()->back()->withErrors(['waliyy_id' => 'The waliyy must be male.']);
    }

    if ($wakilProfile->gender !== 'MALE') {
        return redirect()->back()->withErrors(['wakil_id' => 'The wakil must be male.']);
    }

    // If all validations pass, save the marriage record
    $marriage = new marriagesModel();
    $marriage->husband_id = $husbandProfile->id;
    $marriage->wife_id = $wifeProfile->id;
    $marriage->waliyy_id = $waliyyProfile->id;
    $marriage->wakil_id = $wakilProfile->id;
    $marriage->date = $date;
    $marriage->time = $time;
    $marriage->venue = $venue;
    $marriage->dowry = $dowry;
    $marriage->dowry_status = $dowry_status;
    $marriage->venue_id = $venue_id;
    $marriage->husband_test = $husband_test;
    $marriage->wife_test = $wife_test;
    $marriage->status = null;
    $marriage->approved_by = null;
    $marriage->active = false;
    $marriage->activated_by = null;
    $marriage->activation_date = null;
    $marriage->deactivated_by = null;
    $marriage->deactivation_date = null;
    $marriage->save();

// Notify Imam, Chairman, and Muazzin of the selected Masjid
$masjid = masajidModel::with('imam', 'chairman', 'muazzin')->find($venue_id);

if ($masjid->imam) {
    $masjid->imam->notify(new MarriageRegisteredNotification($marriage));
}
if ($masjid->chairman) {
    $masjid->chairman->notify(new MarriageRegisteredNotification($marriage));
}
if ($masjid->muazzin) {
    $masjid->muazzin->notify(new MarriageRegisteredNotification($marriage));
}

    if(GATE::allows('isAdmin')){
    return redirect('/marriages_database')->with('message', 'Marriage Saved Successfully!');
}

return redirect('/dashboard')->with('message', 'Marriage Saved Successfully!');

}

// Show Single Marriage
public function view($id) {
    $marriage = marriagesModel::with('husband')
    ->with('wife')
    ->with('wakil')
    ->with('waliyy')
    ->with('masjid')
    ->find($id);

    $approvedBy = $marriage->approved_by ? profilesModel::find($marriage->approved_by) : null;
    $activatedBy = $marriage->activated_by ? profilesModel::find($marriage->activated_by) : null;
    $deactivatedBy = $marriage->deactivated_by ? profilesModel::find($marriage->deactivated_by) : null;

    $masjid = $marriage->masjid;

    $userProfile = auth()->user()->profile;

    $husband = $marriage->husband;
    $wife = $marriage->wife;
    $wakil = $marriage->wakil;
    $waliyy = $marriage->waliyy;
    return view('Marriages.single_marriage', compact(
        'marriage', 
        'husband', 
        'wife', 
        'wakil', 
        'waliyy', 
        'approvedBy', 
        'masjid',
        'userProfile',
        'activatedBy',
        'deactivatedBy',
    ));
}


// Show Edit Form
public function edit($id){

$marriage = marriagesModel::find($id);

$masajid = masajidModel::get();
return view('Marriages.edit_marriage', compact('marriage', 'masajid'));
}


// Update Marriage Data
public function update(marriagesRequest $request, $id){

$data = $request->validated();

$marriage = marriagesModel::where('id', $id)->update($data);
return redirect('/marriages_database')->with('message', 'Marriage Data updated Successfully!');
}


// Delete Marriage
public function delete($id) {
$marriage = marriagesModel::where('id', $id)->delete();
return redirect('/marriages_database')->with('message', 'Marriage Deleted Successfully!');
}

    //Display Marriages for Single Profile
    public function showMarriageForProfile($id) {

        $marriages = marriagesModel::where('husband_id', $id)
            ->OrWhere('wife_id', $id)
            // ->OrWhere('waliyy_id', $id)
            ->with('husband')
            ->with('wife')
            ->latest()
            ->filter(request(['search']))
            ->paginate(10);
    
        return view('Marriages.marriages_database', [
            'marriages' => $marriages
        ]);
    
    }

    //Display Marriages for Wakil
    public function showMarriageForWakil($id) {

        $marriages = marriagesModel::where('wakil_id', $id)
            ->with('husband')
            ->with('wife')
            ->latest()
            ->filter(request(['search']))
            ->paginate(10);
    
        return view('Marriages.marriages_database', [
            'marriages' => $marriages
        ]);
    
    }

    //Display Marriages for Waliyy
    public function showMarriageForWaliyy($id) {

        $marriages = marriagesModel::where('waliyy_id', $id)
            ->with('husband')
            ->with('wife')
            ->latest()
            ->filter(request(['search']))
            ->paginate(10);
    
        return view('Marriages.marriages_database', [
            'marriages' => $marriages
        ]);
    
    }

    public function approveMarriage($marriageId)
    {
        $marriage = marriagesModel::find($marriageId);

        $profile = profilesModel::where('user_id', Auth::user()->id)->first();
    
        if ($marriage) {

            if ($marriage->status == 'approved') {
                return redirect()->back()->with('error', 'This marriage has already been approved.');
            }

            $userProfile = auth()->user()->profile;
            
            if (Gate::allows('activate', $marriage)) {
            // Approve the marriage by updating the status and the approved_by field
            $marriage->status = 'approved';
            $marriage->approved_by = $profile->id; // Store the ID of the user who approved the marriage
            $marriage->save();
    
            return redirect('/dashboard')->with('message', 'Marriage approved successfully.');
        }
        }
    
        return redirect()->back()->with('error', 'Marriage not found.');
    }



    public function activateMarriage($marriageId)
{
    // Find the marriage record by its ID
    $marriage = marriagesModel::find($marriageId);

    // Check if the marriage record exists
    if (!$marriage) {
        return redirect()->back()->with('error', 'Marriage not found.');
    }

    // Check if the marriage is already activated
    if ($marriage->active == true) {
        return redirect()->back()->with('error', 'This marriage is already activated.');
    }

    $masjid = $marriage->masjid;
    $masjidChairman = $masjid->chairman_id ?? null;
    $masjidImam = $masjid->imam_id ?? null;
    $masjidMuazzin = $masjid->muazzin_id ?? null;

    // Get the current user's profile
    $userProfile = auth()->user()->profile;

    // Check if the user is Admin or part of the Masjid leadership (Chairman, Imam, Muazzin)
    if (Gate::allows('activate', $marriage)) {

        // Activate the marriage
        $marriage->active = true;
        $marriage->activated_by = $userProfile->id;
        $marriage->activation_date = now();
        $marriage->save();

        // Mark all notifications related to this marriage as read or delete
        $masjidLeadership = [$masjidChairman, $masjidImam, $masjidMuazzin];

        foreach ($masjidLeadership as $leaderId) {
            if ($leaderId) {
                $leader = profilesModel::find($leaderId);
                if ($leader) {
                    $leader->unreadNotifications
                        ->where('data.marriage_id', $marriageId)
                        ->markAsRead(); // or ->delete()
                }
            }
        }

        // Notify the couple or stakeholders (optional)
        // You could add a notification system here if needed

        return redirect('/dashboard')->with('message', 'Marriage activated successfully.');
    } else {
        // If the user is not authorized
        return redirect()->back()->with('error', 'You are not authorized to activate this marriage.');
    }
}


public function deactivateMarriage($marriageId)
{
    // Find the marriage record by its ID
    $marriage = marriagesModel::find($marriageId);

    // Check if the marriage record exists
    if (!$marriage) {
        return redirect()->back()->with('error', 'Marriage not found.');
    }

    // Check if the marriage is already De-activated
    if ($marriage->active = false) {
        return redirect()->back()->with('error', 'This marriage is already De-activated.');
    }

    // Get the current user's profile
    $userProfile = auth()->user()->profile;

    if (Gate::allows('isAdmin')) {

        // De-Activate the marriage
        $marriage->active = false;
        $marriage->deactivated_by = $userProfile->id;
        $marriage->deactivation_date = now();
        $marriage->save();

        // Notify the couple or stakeholders (optional)
        // You could add a notification system here if needed

        return redirect('/dashboard')->with('message', 'Marriage De-activated successfully.');
    } else {
        // If the user is not authorized
        return redirect()->back()->with('error', 'You are not authorized to De-activate this marriage.');
    }
}

    


    }
