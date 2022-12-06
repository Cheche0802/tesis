<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post)
    {
        // return 'subiendo la imagen....';
    	$this->validate(request(), [
    		'photo' => 'required|image|max:2048'
		]);

        $post->photos()->create([
            'url' => request()->file('photo')->store('posts', 'public'),
        ]);
        return Storage::url();
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        // $photoPath= str_replace('storage', 'public',$photo->url);

        // Storage::delete($photoPath);

        return back()->with('flash', 'Foto eliminada');
    }
}
