<?php

namespace Modules\Progress\Http\Controllers;

use Modules\Support\Http\Controllers\BackendController;
use Modules\Progress\Http\Requests\ProgressValidate;
use Modules\Progress\Models\Progress;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ProgressController extends BackendController
{
    public function index(): Response
    {
        $progress = Progress::orderBy('date')
            ->search(request('searchContext'), request('searchTerm'))
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(fn ($progress) => [
                    'id' => $progress->id,
                    'date' => $progress->date,
                    'created_at' => $progress->created_at->format('d/m/Y H:i') . 'h'
            ]);

        return inertia('Progress/ProgressIndex', [
            'progress' => $progress
        ]);
    }

    public function create(): Response
    {
        return inertia('Progress/ProgressForm');
    }

    public function store(ProgressValidate $request): RedirectResponse
    {
        Progress::create($request->validated());

        return redirect()->route('progress.index')
            ->with('success', 'Progress created.');
    }

    public function edit(int $id): Response
    {
        $progress = Progress::find($id);

        return inertia('Progress/ProgressForm', [
            'progress' => $progress
        ]);
    }

    public function update(ProgressValidate $request, int $id): RedirectResponse
    {
        $progress = Progress::findOrFail($id);

        $progress->update($request->validated());

        return redirect()->route('progress.index')
            ->with('success', 'Progress updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Progress::findOrFail($id)->delete();

        return redirect()->route('progress.index')
            ->with('success', 'Progress deleted.');
    }
}
