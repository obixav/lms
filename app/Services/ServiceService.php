<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerDesignRequest;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ServiceService
{

    public function viewServices()
    {
        $services = Service::all();


        return view('admin.services.index', compact('services'));
    }
    public function editService($service_id)
    {

        $service=Service::findOrFail($service_id);
        return view('admin.services.edit',compact('service'));

    }

    public function deleteService($service_id)
    {
        $service=Service::findOrFail($service_id);
        $service->delete();
        return response()->json(['success'=>true,'message' => 'Deleted Successfully'], 200);
    }
    public function saveService($request)
    {
        $service = Service::create([
                'name' => $request->input('name'), 'details' => $request->input('details')
            ]
        );

        if ($request->filled('service_images')) {
            foreach ($request->input('service_images', []) as $file) {
                $service->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('service_images');
            }
        }


        return response()->json(['message' => 'Service Saved Successfully'], 200);
    }
    public function updateService($request)
    {
        $service=Service::findOrFail($request->id);
        $service->update([
                'name' => $request->input('name'), 'details' => $request->input('details')
            ]
        );
        if (count($service->getMedia('service_images')) > 0) {
            foreach ($service->getMedia('service_images') as $media) {
                if (!in_array($media->file_name, $request->input('service_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $service->getMedia('service_images')->pluck('file_name')->toArray();

        foreach ($request->input('service_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $service->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('service_images');
            }
        }


        return response()->json(['message' => 'Service updated Successfully'], 200);
    }

    public function viewSiteServices()
    {
        $services=Service::all();
        return view('services.list','services');
    }

    public function viewSiteService($service_id)
    {
        $service=Service::findOrFail($service_id);
        return view('services.details','service');
    }



}
