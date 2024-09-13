<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('citizen.newcomer',[
            "title" => "Newcomer",
            'citizens' => Citizen::all()
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
            'fullname' => 'required|min:1|max:1000',
            'phone' => 'required',
            'join_date' => 'required|date',
            'marital' => 'required',
            'res_stats' => 'required',
            'id_card' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('citizen.index')->withInput()->withErrors($validator);
        }

        $citizen = new Citizen;
        $citizen->fullname = $request->fullname;
        $citizen->phone = $request->phone;
        $citizen->join_date = $request->join_date;
        $citizen->marital = $request->marital;
        $citizen->res_stats = $request->res_stats;

        if($request->hasFile('id_card')){
            $originalFileName = $request->file('id_card')->getClientOriginalName();
            $filePath = $request->file('id_card')->storeAs('user-idcard', $originalFileName);
            $citizen->id_card = $filePath;
        }

        $citizen->save();
        
        return redirect()->route('citizen.index')->with('success', 'Newcomer Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function show(Citizen $citizen)
    {
        return view('citizen.population',[
            'title' => 'Population',
            'citizens' => Citizen::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $citizen = Citizen::where('id', $id)
                            ->firstOrFail();

        return view('citizen.editnewcomer', compact('citizen'),[
            'citizens' => Citizen::all(),
            'citizens' => $citizen
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citizen $citizen)
    {
        $rules = [
            'fullname' => 'required|min:1|max:1000',
            'phone' => 'required',
            'join_date' => 'required|date',
            'marital' => 'required',
            'res_stats' => 'required',
            'id_card' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('citizen.edit', ['id' => $citizen->id])->withInput()->withErrors($validator);
        }
        
        $citizen->fullname = $request->fullname;
        $citizen->phone = $request->phone;
        $citizen->join_date = $request->join_date;
        $citizen->marital = $request->marital;
        $citizen->res_stats = $request->res_stats;

        if($request->hasFile('id_card')){
            $originalFileName = $request->file('id_card')->getClientOriginalName();
            
            if ($citizen->id_card) {
                Storage::delete($citizen->id_card);
            }

            $filePath = $request->file('id_card')->storeAs('user-idcard', $originalFileName);
            $citizen->id_card = $filePath;
        }

        $citizen->save();
        
        return redirect()->route('citizen.show')->with('success', 'Newcomer Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $citizen = Citizen::where('id', $id)
                        ->firstOrFail();

        // Delete ID Card file
        if (Storage::exists($citizen->id_card)) {
            Storage::delete($citizen->id_card);
        }

        $citizen->delete();
        
        return redirect()->route('citizen.show')->with('success', 'Newcomer Data Deleted Successfully.');
    }
}
