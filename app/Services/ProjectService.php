<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerDesignRequest;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ProjectService
{


    public function viewProjectcategories()
    {
        $projectCategories = ProjectCategory::all();

        return view('admin.project_categories.index', compact('projectCategories'));
    }
    public function saveProjectCategory($request)
    {
        $pc = ProjectCategory::updateOrCreate(
            ['id' => $request->input('id')],
            ['name' => $request->input('name')]
        );
        return response()->json(['message' => 'Changes Saved Successfully'], 200);
    }

    public function viewProjects()
    {
        $projects = Project::all();
        $projectCategories=ProjectCategory::all();

        return view('admin.projects.index', compact('projects','projectCategories'));
    }
    public function editProject($project_id)
    {
        $projectCategories=ProjectCategory::all();
        $project=Project::findOrFail($project_id);
        return view('admin.projects.edit',compact('project','projectCategories'));

    }

    public function deleteProject($project_id)
    {
        $project=Project::findOrFail($project_id);
        $project->delete();
        return response()->json(['success'=>true,'message' => 'Deleted Successfully'], 200);
    }
    public function saveProject($request)
    {
        $project = Project::create([
                'name' => $request->input('name'), 'project_category_id' => $request->input('project_category_id'),
                'date' => date('Y-m-d', strtotime($request->input('date'))), 'description' => $request->input('description'),
                'challenge' => $request->input('challenge'), 'summary' => $request->input('summary'),
                'company'=>$request->input('company')
            ]
        );
        if($request->filled('tags'))
        {
            foreach($request->input('tags') as $t)
            {
                $tag=Tag::firstOrCreate(['name'=>$t]);
                $project->tags()->attach($tag->id);
            }
        }
        if ($request->filled('project_images')) {
            foreach ($request->input('project_images', []) as $file) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('project_main_image');
            }
        }
        if ($request->filled('other_images')) {
            foreach ($request->input('other_images', []) as $file) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('project_other_images');
            }
        }

        return response()->json(['success'=>true,'message' => 'Project Saved Successfully'], 200);
    }
    public function updateProject($request)
    {
        $project=Project::findOrFail($request->id);
        $project->update([
                'name' => $request->input('name'), 'project_category_id' => $request->input('project_category_id'),
                'date' => date('Y-m-d', strtotime($request->input('date'))), 'description' => $request->input('description'),
                'challenge' => $request->input('challenge'), 'summary' => $request->input('summary'),
            ]
        );
        if (count($project->getMedia('project_images')) > 0) {
            foreach ($project->getMedia('project_main_image') as $media) {
                if (!in_array($media->file_name, $request->input('project_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $project->getMedia('project_main_image')->pluck('file_name')->toArray();

        foreach ($request->input('project_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('project_main_image');
            }
        }
        if (count($project->getMedia('project_other_images')) > 0) {
            foreach ($project->getMedia('project_other_images') as $media) {
                if (!in_array($media->file_name, $request->input('other_images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $project->getMedia('project_other_images')->pluck('file_name')->toArray();

        foreach ($request->input('other_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('project_other_images');
            }
        }

        return response()->json(['success'=>true,'message' => 'Project updated Successfully'], 200);
    }

    public function viewDesignRequests($request)
    {
        $projectCategories=ProjectCategory::all();
        $customers=Customer::all();
        $design_requests = CustomerDesignRequest::all();
        return view('admin.design_requests.index', compact('design_requests','projectCategories','customers'));
    }
    public function viewDesignRequest($design_request_id)
    {
        $design_request=CustomerDesignRequest::findOrFail($design_request_id);
        return view('admin.design_requests.response',compact('design_request'));
    }
    public function saveDesignRequestResponse($request)
    {
        $designRequest=CustomerDesignRequest::findOrFail($request->id);


        $designRequest->update(['response'=>$request->input('response'),
        'can_preview_request'=>$request->input('can_preview_request')]);
        if ($request->filled('response_images')) {
            foreach ($request->input('response_images', []) as $file) {
                $designRequest->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('response_images');
            }
        }
        // todo notify customer
        return response()->json(['success'=>true,'message' => 'Response Saved Successfully'], 200);
    }
    public function saveDesignRequest($request)
    {
        $customer=Customer::firstOrCreate(['email'=>$request->input('email')],[
            'name'=>$request->input('name'),'phone'=>$request->input('phone')
        ]);
        $ulid = Str::ulid();
       $designRequest=CustomerDesignRequest::create(['customer_id'=>$customer->id,
        'project_category_id'=>$request->input('category_id'),'preview_code'=>$ulid,
       'budget'=>$request->input('budget'),'message'=>$request->input('message'),
           'quantity'=>$request->input('quantity'), 'can_preview_request'=>0]);
        if ($request->filled('request_images')) {
            foreach ($request->input('request_images', []) as $file) {
                $designRequest->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('request_images');
            }
        }
        //todo notify Admin
        return response()->json(['success'=>true,'message' => 'Request Submitted Successfully'], 200);
    }
}
