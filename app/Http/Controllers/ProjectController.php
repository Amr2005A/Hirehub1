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
use App\Policies\ProjectPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class ProjectController extends Controller
{
        use AuthorizesRequests;
    public function index(Request $request)
{
    $projects = Project::query()->open()

        ->when($request->min_budget, function ($q) use ($request) {
            $q->minBudget($request->min_budget);
        })

        ->when($request->max_budget, function ($q) use ($request) {
            $q->maxBudget($request->max_budget);
        })

        ->when($request->this_month, function ($q) {
            $q->thisMonth();
        })
        ->get();

    return response()->json($projects);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $this->authorize('create',Project::class);

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
        $tags=$project->tags()->sync($request->tags);
        $project->load('tags');
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
        $this->authorize('update',$project);
        $data = $request->validated();

        $project->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? $project->description,
            'budget_type' => $data['budget_type'] ?? $project->budget_type,
            'hourly_price' => $data['hourly_price'] ?? $project->hourly_price,
            'fixed_price' => $data['fixed_price'] ?? $project->fixed_price,
            'date' => $data['date'] ?? $project->date,
            'file_path' => $data['file_path'] ?? $project->file_path,
            'status' => $data['status'] ?? $project->status,
        ]);

        if (isset($data['tags'])) {
            $project->tags()->sync($data['tags']);
        }

        $project->load('tags');

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
        $this->authorize('forceDelete',$project);

        Project::destroy($project->id);
        return response()->json([
            'message' => 'Project deleted successfully',
        ], 200);
    }
}
