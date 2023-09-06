<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Customer;
use App\Models\CustomerDesignRequest;
use App\Models\Service;
use App\Models\Tag;
use App\Models\TeamMember;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class TeamMemberService
{

    public function viewTeamMembers()
    {
        $team_members = TeamMember::all();


        return view('admin.team_members.index', compact('team_members'));
    }
    public function editTeamMember($team_member_id)
    {

        $team_member=TeamMember::findOrFail($team_member_id);
        return view('admin.team_members.edit',compact('team_member'));

    }

    public function deleteTeamMember($team_member_id)
    {
        $team_member=TeamMember::findOrFail($team_member_id);
        $team_member->delete();
        return response()->json(['success'=>true,'message' => 'Deleted Successfully'], 200);
    }
    public function saveTeamMember($request)
    {
        $team_member = TeamMember::create([
                'name' => $request->input('name'), 'role' => $request->input('role'),
                'facebook' => $request->input('facebook'),'twitter' => $request->input('twitter')
            ]
        );

        if ($request->filled('team_member_images')) {
            foreach ($request->input('team_member_images', []) as $file) {
                $team_member->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('avatar');
            }
        }


        return response()->json(['message' => 'TeamMember Saved Successfully'], 200);
    }
    public function updateTeamMember($request)
    {
        $team_member=TeamMember::findOrFail($request->id);
        $team_member->update([
                'name' => $request->input('name'), 'role' => $request->input('role'),
                'facebook' => $request->input('facebook'),'twitter' => $request->input('twitter')
            ]
        );
        if (count($team_member->getMedia('avatar')) > 0) {
            foreach ($team_member->getMedia('avatar') as $media) {
                if (!in_array($media->file_name, $request->input('team_member_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $team_member->getMedia('avatar')->pluck('file_name')->toArray();

        foreach ($request->input('team_member_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $team_member->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('avatar');
            }
        }


        return response()->json(['message' => 'TeamMember updated Successfully'], 200);
    }



}
