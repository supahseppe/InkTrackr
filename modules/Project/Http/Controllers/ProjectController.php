<?php

namespace Modules\Project\Http\Controllers;

use Modules\Support\Http\Controllers\BackendController;
use Modules\Project\Http\Requests\ProjectValidate;
use Modules\Project\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class ProjectController extends BackendController
{
    public function index(): Response
    {
        $projects = Project::orderBy('title')
            ->where('owner_id', Auth::user()->id)
            ->search(request('searchContext'), request('searchTerm'))
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(fn ($project) => [
                    'id' => $project->id,
                    'title' => $project->title,
                    'description' => $project->description,
                    'created_at' => $project->created_at->format('d/m/Y H:i') . 'h'
            ]);

        return inertia('Project/ProjectIndex', [
            'projects' => $projects
        ]);
    }

    public function view(int $id): Response
    {
        $project = Project::with('progress')->find($id);
        
        return inertia('Project/ProjectView', [
            'project' => $project
        ]);
    }

    public function create(): Response
    {
        return inertia('Project/ProjectForm');
    }

    public function store(ProjectValidate $request): RedirectResponse
    {
        Project::create(array_merge($request->validated(), ['owner_id' => Auth::user()->id]));

        return redirect()->route('project.index')
            ->with('success', 'Project created.');
    }

    public function edit(int $id): Response
    {
        $project = Project::find($id);

        return inertia('Project/ProjectForm', [
            'project' => $project
        ]);
    }

    public function update(ProjectValidate $request, int $id): RedirectResponse
    {
        $project = Project::findOrFail($id);

        $project->update($request->validated());

        return redirect()->route('project.index')
            ->with('success', 'Project updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Project::findOrFail($id)->delete();

        return redirect()->route('project.index')
            ->with('success', 'Project deleted.');
    }
}
