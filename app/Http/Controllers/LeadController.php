<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\City;
use App\Models\Lead;
use App\Models\Leader;
use App\Models\States;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LeadController extends Controller
{
    public function create(Request $request)
    {
        dd($request->all());
        $de = array('(',')',' ','-');
        $para = array('','','','');
        $request->tel = "55".str_replace($de, $para, $request->tel);

            //dd($request->tel);        

        $lead = Lead::create([
            'page_id' => $request->page_id,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->tel,
            'email' => isset($request->email) ? $request->email : null,
            'age' => $request->age,
            'state' => $request->state,
            'city' => $request->city,
            'school' => $request->city
        ]);
        //$lead = 1;

        //$fb = new ConversionApiFB;
        //$request->city = City::find($request->city)->name;
        //$request->state = States::find($request->state)->abbr;

        //dd($request->state);
        //$fb->Lead($request);
        return Redirect::to("/page/end?tel=5544998354889&page=premilitar&lead=$lead");
    }

    public function leader(Request $request)
    {
        //dd(count($request->leads));
        $de = array('(',')',' ','-');
        $para = array('','','','');
        foreach($request->leads as $lead){
            //dd($lead);
            $lead['tel'] = "55".str_replace($de, $para, $lead['tel']);
            //dd($lead);
            $lead = Lead::create([
                'name' => $lead['name'],
                'phone' => $lead['tel'],
                'state' => $request->state,
                'city' => $request->city,
                'school' => $request->school
            ]);
        }
        
        
        $leader = Leader::create([
            'leader_name' => $request->leads[0]['name'],
            'leader_phone' => "55".str_replace($de, $para, $request->leads[0]['tel']),
            'school_name' => $request->school,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'body' => json_encode($request->all())
        ]);

            //dd($request->tel);        

        
        
        //$lead = 1;

        //$fb = new ConversionApiFB;
        //$request->city = City::find($request->city)->name;
        //$request->state = States::find($request->state)->abbr;

        //dd($request->state);
        //$fb->Lead($request);
        //return Redirect::to("/page/end?tel=5544998354889&page=premilitar&lead=$lead");

        $status = $request->leads[0]['name']. " " . count($request->leads) . " Indicações enviadas com sucesso!";
        return back()->with('status', __($status));

        return back();
    }

    public function like_up(BlogPost $id){
        dd($id);
        
    }
    
}
