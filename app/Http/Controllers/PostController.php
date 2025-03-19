<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    // создать пост
    public function create(PostRequest $request){

        $this->postService->create($request);

        return redirect('userpage')->with('success_post', 'Ваш пост успешно опубликован.');
    }

    public function delete($id) {
        
        $this->postService->delete($id);

        return redirect()->back()->with('success_post', 'Пост успешно удален.');

    }
}
