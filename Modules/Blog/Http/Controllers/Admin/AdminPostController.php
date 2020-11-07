<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Inertia\Inertia;
use Modules\Blog\Http\Requests\StorePostRequest;
use Modules\Blog\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Redirect;
use Modules\Blog\Entities\Category;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('blog::Admin/PostIndex');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('blog::Admin/PostCreate', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        return Redirect::back()->with('success', 'post created.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($slug)
    {
        $post = Post::findOrFail($slug);
        return Inertia::render('blog::Admin/PostShow', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return Inertia::render('blog::Admin/PostEdit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update($request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
