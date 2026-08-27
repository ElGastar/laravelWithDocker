<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = [
        [
            'name' => 'John Doe1',
            'email' => '1',],
        [
            'name' => 'John Doe2',
            'email' => '2',
        ],
        [
            'name' => 'John Doe3',
            'email' => '3',
        ],
        
        ];


        foreach ($item as $value) {
            Post::create([
                'name' => $value['name'],
                'email' => $value['email'], 
            ]);
        }
    
    return redirect('/')->with('success', 'Пост создан!');
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
      
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        $post=Post::find(4);
        $post->update([
            'name' => 'update',
            'email' => 'update',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
