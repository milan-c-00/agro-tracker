<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    }

    public function index() {

        $posts = $this->postService->index();
        if(!$posts){
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response($posts, ResponseAlias::HTTP_OK);
    }

    public function post_widget() {

        $post_widget = $this->postService->post_widget();
        if($post_widget){
            return $post_widget;
        }
        else{
            return response(['message' => 'Not found!'], ResponseAlias::HTTP_NOT_FOUND);
        }

    }

    public function show(Post $post){
        $post_res = $this->postService->show($post);
        if(!$post_res)
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return response($post, ResponseAlias::HTTP_OK);
    }

    public function store(Request $request){
        $post = $this->postService->store($request);
        if(!$post)
            return response(['message' => 'Unprocessable entity!'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return response($post, ResponseAlias::HTTP_CREATED);
    }

    public function update(Post $post, Request $request){
        $updated = $this->postService->update($post, $request);
        if (!$updated){
            return response(['message' => 'Update failed!'], ResponseAlias::HTTP_BAD_REQUEST);
        }
        return response(['message' => 'Update successful!'], ResponseAlias::HTTP_OK);
    }

    public function destroy(Post $post) {
        $deleted = $this->postService->destroy($post);
        if (!$deleted){
            return response(['message' => 'Delete failed!'], ResponseAlias::HTTP_BAD_REQUEST);
        }
        return response(['message' => 'Delete successful!'], ResponseAlias::HTTP_OK);
    }


}
