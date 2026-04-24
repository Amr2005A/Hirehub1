<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProjecResource;
use Symfony\Component\HttpKernel\HttpCache\Store;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $request->validated();
       $project = Project::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'description' => $request->description,
        'budget_type' => $request->budget_type,
        'hourly_price' => $request->hourly_price,
        'fixed_price' => $request->fixed_price,
        'date' => $request->date,
        'status' => 'open',
        'file_path' => $request->file_path,
       ]);

       return response()->json([
        'message' => 'Project created successfully',
        'project' => ProjectResource::make($project),
       ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return ProjectResource::make($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->validated();
        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'budget_type' => $request->budget_type,
            'hourly_price' => $request->hourly_price,
            'fixed_price' => $request->fixed_price,
            'date' => $request->date,
            'file_path' => $request->file_path,
        ]);
        return response()->json([
            'message' => 'Project updated successfully',
            'project' => ProjectResource::make($project),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Project::destroy($project->id);
        return response()->json([
            'message' => 'Project deleted successfully',
        ], 200);
    }
}
