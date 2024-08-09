<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->whereJsonContains('locales', app()->getLocale())->with('image')->paginate(12);

        return view('projects.index', compact('projects'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->loadMissing('media');

        $latest_projects = Project::latest()->where('id', '!=', $project->id)->limit(6)->get();

        return view('projects.show', compact('project', 'latest_projects'));
    }
}
