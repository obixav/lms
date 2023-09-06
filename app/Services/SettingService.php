<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Service;
use App\Models\Setting;

class SettingService{

    public function viewSetting(){
        $setting=Setting::firstOrCreate([ 'email'=>'Richconceptunlimited@gmail.com'],['store_name'=>'Rich Concept Unlimited',
  'address'=>'Block C32 Alcobre Plaza, Opposite St. Patrick Church, Ojo L.G.A, Lagos state, Nigeria',
    'copyright'=>'','phone'=>'','facebook'=>'','instagram'=>'','maintenance_mode'=>0,'small_announcement'=>'','big_announcement'=>'','tax_rate'=>'',
            'discount_announcement'=>'']);

    return view('admin.settings.index',compact('setting'));
    }
    public function saveSetting($request){
        $mm=$request->input('maintenance_mode')=='on'?1:0;
        $setting=Setting::first();
        $setting->update(['store_name'=>$request->input('store_name'),
        'email'=>$request->input('email'),'address'=>$request->input('address'),
        'copyright'=>$request->input('copyright'),'phone'=>$request->input('phone'),
            'facebook'=>$request->input('facebook'),'instagram'=>$request->input('instagram'),'maintenance_mode'=>$mm,
            'small_announcement'=>$request->input('small_announcement'),'big_announcement'=>$request->input('big_announcement'),'tax_rate'=>$request->input('tax_rate'),
            'discount_announcement'=>$request->input('discount_announcement')]);
        return response()->json(['success'=>true,'message'=>'Changes Saved Successfully'],200);
    }

    public function viewServices()
    {
        $services = Service::all();

        return view('admin.services.index', compact('services'));
    }
    public function saveService($request)
    {
        $service = Service::updateOrCreate(
            ['id' => $request->input('id')],
            ['name' => $request->input('name'),
            'details'=>$request->input('details')
            ]
        );
        if ($request->hasFile('service_image')) {

                $path = $request->file('service_image')->store('service_image');
                $service->update(['file'=>$path]);

        }
        return response()->json(['message' => 'Changes Saved Successfully'], 200);
    }
    public function viewClients()
    {
        $clients = Client::all();

        return view('admin.clients.index', compact('clients'));
    }
    public function saveClient($request)
    {
        $client = Client::updateOrCreate(
            ['id' => $request->input('id')],
            ['name' => $request->input('name'),
            'comment'=>$request->input('comment'),
            'designation'=>$request->input('designation'),
            ]
        );
        if ($request->hasFile('client_image')) {

                $path = $request->file('client_image')->store('client_image');
                $client->update(['file'=>$path]);

        }
        return response()->json(['message' => 'Changes Saved Successfully'], 200);
    }
}

