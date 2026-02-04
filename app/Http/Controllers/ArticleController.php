<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;



class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view articles')->only('index');
        $this->middleware('permission:create articles')->only(['create', 'store']);
        $this->middleware('permission:edit articles')->only(['edit', 'update']);
        $this->middleware('permission:delete articles')->only('destroy');
    }

// return [
//     new Middleware('permission:view users',only:['index']),
//     new Middleware('permission:edit users',only:['edit']),
//     new Middleware('permission:create users',only:['create']),
//     new Middleware('permission:delete users',only:['delete']),
// ]
    public function index()
{
    // Latest articles first
    $articles = Article::orderBy('id', 'DESC')->paginate(10);

    return view('articles.list', compact('articles'));
}


    // Show create form
    public function create()
    {
        return view('articles.create');
    }

    // Store article
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|min:3',
            'text'   => 'nullable',
            'author' => 'required'
        ]);

        Article::create([
            'title'  => $request->title,
            'text'   => $request->text,
            'author' => $request->author,
        ]);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article created successfully');
    }

    // Show single article
public function show($id)
{
    // Find the article or fail
    $article = Article::findOrFail($id);

    // Return the view with the article
    return view('articles.show', compact('article'));
}


    // Show edit form
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    // Update article
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title'  => 'required|min:3',
            'text'   => 'nullable',
            'author' => 'required'
        ]);

        $article->update([
            'title'  => $request->title,
            'text'   => $request->text,
            'author' => $request->author,
        ]);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article updated successfully');
    }

    // Delete article
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article deleted successfully');
    }
}
