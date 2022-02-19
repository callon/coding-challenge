<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Project;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function start(Project $project)
    {
	    Entry::create([
		    'project_id' => $project->id,
	    ]);
		return response()->json($project->entries);
    }

    public function stop(Project $project)
    {
		$entry = $project->entries()->whereNull('end')->first();
		if(!$entry){
			abort(422, 'No started entry found');
		}
		
		$entry->end = now();
		$entry->save();
		
		return response()->json($project->entries);
    }
}
