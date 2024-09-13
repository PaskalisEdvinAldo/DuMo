<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citizen = Citizen::select('id', 'fullname')->get();

        return view('payment.billing', compact('citizen'),[
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
            'cit_name' => 'required',
            'invoice' => 'required|date',
            'method' => 'required',
            'category' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('payment.index')->withInput()->withErrors($validator);
        }

        $payment = new Payment;
        $payment->cit_name = $request->cit_name;
        $payment->invoice = $request->invoice;
        $payment->method = $request->method;
        $payment->category = $request->category;

        $payment->save();
        
        return redirect()->route('payment.index')->with('success', 'Invoice Paid Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $payment = Payment::all();
        
        return view('payment.history', compact('payment'),[
            'payments' => Payment::all(),
            'payments' => $payment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::where('id', $id)
                            ->firstOrFail();

        $allPayment = Payment::all();

        $citizen = Citizen::all();

        return view('payment.editbilling',[
            'payments' => $allPayment,
            'payment' => $payment,
            'citizens' => Citizen::all(),
            'citizen' => $citizen
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $rules = [
            'cit_name' => 'required',
            'invoice' => 'required|date',
            'method' => 'required',
            'category' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('payment.show')->withInput()->withErrors($validator);
        }

        $payment->cit_name = $request->cit_name;
        $payment->invoice = $request->invoice;
        $payment->method = $request->method;
        $payment->category = $request->category;

        $payment->save();
        
        return redirect()->route('payment.show')->with('success', 'Invoice Paid Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::where('id', $id)
                        ->firstOrFail();

        $payment->delete();
        
        return redirect()->route('payment.edit')->with('success', 'Invoice Info Deleted Successfully.');
    }
}
