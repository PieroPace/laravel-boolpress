<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Model\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(8);

        return response()->json([
            'response' => true,
            'results' =>  $posts,
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return response()->json([
            'response' => true,
            'count' => $post ? 1 : 0,
            'results' =>  [
                'data' => $post
            ],
        ]);
    }

    public function inRandomOrder()
    {
        $posts = Post::inRandomOrder()->limit(4)->get();
        return response()->json([
            'response' => true,
            'results' => [
                'data' => $posts
            ],
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $posts = Post::where('id', '>=', 1);

        if (
            array_key_exists('orderbycolumn', $data) &&
            array_key_exists('orderbysort', $data)
        ) {
            $posts->orderBy($data['orderbycolumn'], $data['orderbysort']);
        }

        if (array_key_exists('tags', $data)) {
            foreach ($data['tags'] as $tag) {
                $posts->whereHas('tags', function (Builder $query) use ($tag) {
                    $query->where('name', '=', $tag);
                });
            }
        }

        $posts = $posts->with(['tags', 'category'])->get();

        return response()->json([
            'response' => true,
            'count' =>  $posts->count(),
            'results' =>  [
                'data' => $posts
            ],
        ]);
    }
}
