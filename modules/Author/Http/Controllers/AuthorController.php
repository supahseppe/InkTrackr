<?php

namespace Modules\Author\Http\Controllers;

use Modules\Support\Http\Controllers\BackendController;
use Modules\Author\Http\Requests\AuthorValidate;
use Modules\Author\Models\Author;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class AuthorController extends BackendController
{
    public function index(): Response
    {
        $authors = Author::orderBy('name')
            ->search(request('searchContext'), request('searchTerm'))
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(fn ($author) => [
                    'id' => $author->id,
                    'name' => $author->name,
                    'created_at' => $author->created_at->format('d/m/Y H:i') . 'h'
            ]);

        return inertia('Author/AuthorIndex', [
            'authors' => $authors
        ]);
    }

    public function create(): Response
    {
        return inertia('Author/AuthorForm');
    }

    public function store(AuthorValidate $request): RedirectResponse
    {
        Author::create($request->validated());

        return redirect()->route('author.index')
            ->with('success', 'Author created.');
    }

    public function edit(int $id): Response
    {
        $author = Author::find($id);

        return inertia('Author/AuthorForm', [
            'author' => $author
        ]);
    }

    public function update(AuthorValidate $request, int $id): RedirectResponse
    {
        $author = Author::findOrFail($id);

        $author->update($request->validated());

        return redirect()->route('author.index')
            ->with('success', 'Author updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Author::findOrFail($id)->delete();

        return redirect()->route('author.index')
            ->with('success', 'Author deleted.');
    }
}
