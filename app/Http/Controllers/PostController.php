<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;
use App\Comment;
use App\Notifications\PostNoty; 

class PostController extends Controller
{
    
    public function __construct()
    {
        return $this->middleware('auth')->except('index', 'show');
    }


    public function index()
    {

        $posts = Post::OrderBy('created_at', 'desc')->paginate(30);
        
        // Cache::put('users', $cahe)
        // $posts = Cache::get('users');

        return view('posts.index', compact('posts'));


    }
    
    public function create()
    {
        $categories = DB::select('select id, name from categories');
        return view('posts.create', compact('categories'));
    }


   public function store(Request $request)
   {
        // $this->authorize('update', Post::class);

        $data = request()->validate([
            'category_id' => 'required',
            'title' => 'required|unique:posts,title|min:2|max:255|string',
            'desc' => 'required|string|min:2|max:5000',
            'img' => 'image|nullable',
        ]);

        if($request->hasFile('img')){
        $imagePath = $request->img->store('images', 'public');
        }

        $post = auth()->user()->posts()->firstOrCreate([
                'user_id' => auth()->user()->id,
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'slug' => trim(Str::limit(Str::slug($data['title']), 50, ''), '-'),
                'desc' => $data['desc'],
                'img' => $imagePath ?? '',
                'comments_count' => 0,
                'views_count' => 0,
                'best_reply' => 0,
                'locked' => false,
                'pinned' => 0,

        ]);

        return redirect()->route('posts.show', compact('post'));
 
   }

   
    public function show(Post $post, User $user)
    {
        $isLiked = (bool) $post->likes(['like' => 1])->first();
        $comments = $post->comments()->paginate(10);

        $follows =  (auth()->user()) ? auth()->user()->content->contains($post->id) : false;

        $post->increment('views_count');
      

        return view('posts.show', compact('post', 'isLiked', 'comments', 'follows'));
    }
   
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {

        $this->authorize('update', $post);

        $data = request()->validate([
            'category_id' => 'required',
            'title' => 'required|min:2|max:255|string',
            'desc' => 'required|string|min:2|max:10000',
            'img' => 'image|nullable',
        ]);

        if($request->hasFile('img')){
            $imagePath = $request->img->store('images', 'public');
            $imageArray = ['img' => $imagePath];
        }

        $others = array_merge($data, [
            'slug' => trim(Str::limit(Str::slug($data['title']), 50, ''), '-'), 
        ]);

        $post->update(array_merge($others,  $imageArray ?? []));
        
         return redirect()->route('posts.show', compact('post'));
        
    }


   public function destroy(Post $post)
   {
        $post->delete();
         return redirect()->route('posts.index');
   }

    
}
