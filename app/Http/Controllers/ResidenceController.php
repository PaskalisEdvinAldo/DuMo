<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Residence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citizen = Citizen::select('id', 'fullname')->get();
        $existingHouseNumber = Residence::pluck('house_number')->toArray();
        $existingOccupantOrder = Residence::pluck('oc_list')->toArray();

        return view('residence.building', compact('citizen', 'existingHouseNumber', 'existingOccupantOrder'),[
            'citizens' => Citizen::all(),
            'citizens' => $citizen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'house_number' => 'required',
            'oc_list' => 'required',
            'oc_name' => 'required',
            'house' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('residence.index')->withInput()->withErrors($validator);
        }

        $residence = new Residence;
        $residence->house_number = $request->house_number;
        $residence->oc_list = $request->oc_list;
        $residence->oc_name = $request->oc_name;
        $residence->house = $request->house;

        $residence->save();
        
        return redirect()->route('residence.index')->with('success', 'Property Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function show(Residence $residence)
    {
        $residence = Residence::all();
        
        return view('residence.resident', compact('residence'),[
            'residences' => Residence::all(),
            'residences' => $residence
        ]);
    }
    
    public function history(Residence $residence)
    {
        $residence = Residence::all();
        
        return view('residence.residenthistory', compact('residence'),[
            'residences' => Residence::all(),
            'residences' => $residence
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $residence = Residence::where('id', $id)
                            ->firstOrFail();

        $allResidence = Residence::all();

        return view('residence.editresident',[
            'residences' => $allResidence,
            'residence' => $residence
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Residence $residence)
    {
        $rules = [
            'house_number' => 'required',
            'oc_list' => 'required',
            'oc_name' => 'required|array',
            'house' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->route('residence.edit', ['id' => $residence->id])->withInput()->withErrors($validator);
        }
        
        $house_number = $request->house_number;
        $oc_list = $request->oc_list;
        $house = $request->house;
        
        Residence::where('house_number', $house_number)
            ->where('oc_list', $oc_list)
            ->update(['house' => $house]);
        
        foreach ($request->oc_name as $oc_name) {
            $existingResidence = Residence::where('house_number', $house_number)
                                          ->where('oc_list', $oc_list)
                                          ->where('oc_name', $oc_name)
                                          ->first();
        
            if (!$existingResidence) {
                $residence = new Residence;
                $residence->house_number = $house_number;
                $residence->oc_list = $oc_list;
                $residence->oc_name = $oc_name;
                $residence->house = $house;
        
                $residence->save();
            }
        }
        
        return redirect()->route('residence.show')->with('success', 'Property Data Updated Successfully!');        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Residence  $residence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $residence = Residence::where('id', $id)
                        ->firstOrFail();

        $residence->delete();
        
        return redirect()->route('residence.edit')->with('success', 'Resident Data Deleted Successfully.');
    }
}
