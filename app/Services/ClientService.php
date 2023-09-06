<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Customer;
use App\Models\CustomerDesignRequest;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ClientService
{

    public function viewClients()
    {
        $clients = Client::all();


        return view('admin.clients.index', compact('clients'));
    }
    public function editClient($client_id)
    {

        $client=Client::findOrFail($client_id);
        return view('admin.clients.edit',compact('client'));

    }

    public function deleteClient($client_id)
    {
        $client=Client::findOrFail($client_id);
        $client->delete();
        return response()->json(['success'=>true,'message' => 'Deleted Successfully'], 200);
    }
    public function saveClient($request)
    {
        $client = Client::create([
                'name' => $request->input('name'), 'details' => $request->input('details'),
                'comment' => $request->input('comment'),'designation' => $request->input('designation')
            ]
        );

        if ($request->filled('client_images')) {
            foreach ($request->input('client_images', []) as $file) {
                $client->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('avatar');
            }
        }


        return response()->json(['message' => 'Client Saved Successfully'], 200);
    }
    public function updateClient($request)
    {
        $client=Client::findOrFail($request->id);
        $client->update([
                'name' => $request->input('name'), 'details' => $request->input('details'),
                'comment' => $request->input('comment'),'designation' => $request->input('designation')
            ]
        );
        if (count($client->getMedia('avatar')) > 0) {
            foreach ($client->getMedia('avatar') as $media) {
                if (!in_array($media->file_name, $request->input('client_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $client->getMedia('avatar')->pluck('file_name')->toArray();

        foreach ($request->input('client_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $client->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('avatar');
            }
        }


        return response()->json(['message' => 'Client updated Successfully'], 200);
    }



}
