<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::orderBy('name', 'asc')->get();
        $technologies = Technology::orderBy('name', 'asc')->get();

        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|max:50|string|',
            'link_project' => 'required|string',
            'description' => 'nullable|string',
            'technologies' => 'exists:technologies,id'
        ]);

        $data = $request->all();
        $new_project = Project::create($data);

        if ($request->has('technologies')) {
            $new_project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $categories = Category::orderBy('name', 'asc')->get();
        $technologies = Technology::orderBy('name', 'asc')->get();


        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:50|string',
            'link_project' => 'required|string',
            'description' => 'nullable|string',
            'technologies' => 'exists:technologies,id'
        ]);

        $data = $request->all();
        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            // si può usare anche sync passando l'array vuoto
            // $project->technologies()->sync([]);
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
