<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\StoreRequest;
use App\Http\Requests\Projects\UpdateRequest;
use App\Project;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $projectID)
    {
        $project = Project::with('entries')->find($projectID);
        return view('projects.show', ['project' => $project]);
    }
	
    public function store(StoreRequest $request)
    {
        Project::create($request->validated());
        return response()->json(['status' => 'success']);
    }

    public function update(UpdateRequest $request, Project $project)
    {
        $project->update($request->validated());
        return response()->json(['status' => 'success']);
    }
	
	public function destroy(Project $project){
		$project->delete();
		return response()->json(['status' => 'success']);
	}
}
