<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post as PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class PostController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $posts = Post::paginate(15);
        return PostResource::collection($posts);
    }

    public function show($id): PostResource
    {
        $Post = Post::findOrFail($id);
        return new PostResource($Post);
    }

    public function store(Request $request, Response $response)
    {
        $Post = new Post;
        $Post->title = $request->input('title');
        $Post->content = $request->input('content');
        $Post->medias = $request->input('medias');
        $Post->user_id = $request->input('user_id');

        if ($Post->save()) {
            return new PostResource($Post);
        }
        return $response->setStatusCode(500)->setContent(json_encode(['fail']))->send();
    }

    public function update(Request $request, Response $response)
    {
        $Post = Post::findOrFail($request->id);
        $Post->title = $request->input('title');
        $Post->content = $request->input('content');

        if ($Post->save()) {
            return new PostResource($Post);
        }
        return $response->setStatusCode(500)->setContent(json_encode(['fail']))->send();
    }

    public function destroy($id)
    {
        $Post = Post::findOrFail($id);
        if ($Post->delete()) {
            return new PostResource($Post);
        }
        return (new Response('fail',500))->send();
    }
}
