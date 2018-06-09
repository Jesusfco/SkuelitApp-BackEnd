<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentType;
use App\PaymentDates;
use App\Period;

class PaymentController extends Controller
{
    public function get(Request $request) {
        return response()->json(PaymentType::all());
    }

    public function getLastsPeriods() {
        return response()->json(Period::all());
    }

    public function getPaymentDates($id) {
        $dates = PaymentDate::where('payment_type_id', $id)->get();
        return response()->json($dates);
    }

    public function store(Request $request) {
        
        $payment = new PaymentType();
        $payment->name = $request->name;
        $payment->description = $request->description;
        $payment->quantity = $request->quantity;
        $payment->amount = $request->amount;
        $payment->period_type_id = $request->period_type_id;
        $payment->save();

        return response()->json($payment);

    }

    public function storeDates(Request $request) {
        
        $payment_type;
        $period;

        foreach($request->dates as $date) {

            $d = new PaymentDates();
            $d->date =  $date['date'];
            $d->payment_type_id = $date['payment_type_id'];
            $d->period_id = $date['period_id'];
            $d->save();

            $payment_type = $d->payment_type_id;
            $period = $d->period_id;
        }

        return response()->json(
                                PaymentDates::where([
                                    ['payment_type_id', $payment_type],
                                    ['period_id', $period],
                                    ])->get()
                                );    

    }

    public function latestPeriods() {
        return response()->json(Period::all());
    }

    public function getDatesPayment(Request $request) {

        $dates = PaymentDates::where([
            ['period_id', $request->period_id],
            ['payment_type_id', $request->payment_type_id],
            ])->get();

        return response()->json($dates);

    }

    public function storePaymentDates(Request $request) {

        $re = [];

        foreach($request->dates as $date) {

            if($date['id'] <= 0) {

                $d = new PaymentDates();
                $d->date = $date['date'];
                $d->period_id = $date['period_id'];
                $d->payment_type_id = $date['payment_type_id'];
                $d->save();

            }  else {
            
                $d = PaymentDates::find($date['id']);
                $d->date = $date['date'];
                $d->save();

            }

            $re[] = $d;

        }

        return response()->json($re);

    }



}
