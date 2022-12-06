<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;

class AdminPostsController extends Controller
{
    public function index()
    {
        $posts = Post::allowed()->get();

    	return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Post);

        $this->validate($request, ['title' => 'required|min:3']);

        $post = Post::create( $request->all() );

        return redirect()->route('posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    public function update(Post $post, StorePostRequest $request)
    {
        $this->authorize('update', $post);

        $post->update($request->all());

        $post->syncTags($request->get('tags'));

        // $post->syncP

        return redirect()
            ->route('posts.edit', $post)
            ->with('flash', 'La publicación ha sido guardada');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('flash', 'La publicación ha sido eliminada');
    }

}
