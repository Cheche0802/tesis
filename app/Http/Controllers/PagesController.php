<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function home()
    {
        $query = Post::published('DESC');

        if(request('month')) {
            $query->whereMonth(request('month'));
        }

        if(request('year')) {
            $query->whereYear(request('year'));
        }

		$posts = $query->paginate();

    	return view('pages.home', compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        // $archive =  Post::selectRaw('year(published_at) year')
        //         ->selectRaw('monthname(published_at) month')
        //         ->selectRaw('count(*) posts')
        //         ->groupBy('year', 'month')
        //         ->orderBy('published_at - created_at DESC')
        //         ->get();

        $arch = DB::table('posts')
                    ->select(
                        DB::raw('year(published_at) as year, monthname(published_at) as month, count(*) as posts_count')
                        )
                    // ->select(DB::raw('count(*) as posts'))
                    ->groupByRaw('year, month')
                    // ->orderByRaw('published_at DESC') // ve como pueces hacer este funcionar
                    ->get();

        // dd($arch);

        return view('pages.archive', [
            'authors' => User::latest()->take(4)->get(),
            'categories' => Category::take(7)->get(),
            'posts' => Post::latest('published_at')->take(5)->get(),
            // 'archive' => $archive
            'archive' => $arch
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

}
