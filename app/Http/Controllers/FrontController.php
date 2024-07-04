<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Tag, Post};
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(4)->get();
        $categories= Category::all();
        $tagar= Tag::all();
        return view('kegiatan.index', compact('posts', 'categories', 'tagar'));
        //return view('welcome', [compact ('posts'), ('category'), ('tag')]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('kegiatan.detail', compact('post'));
    }

    public function category(Category $category)
    {
      //$posts = Post::latest()->get();
      //return view ('welcome',compact('categories','posts', 'tagar'));

        $posts = $category->posts()->latest()->get();
        $categories= Category::all();
        $tagar= Tag::all();
        return view('kegiatan.index', compact('posts', 'categories', 'tagar'));
    }

    public function tag(Tag $tag)
    {
        //$posts = $tag->posts()->latest()->get();
        //return view ('welcome',compact('tag','posts'));

        $posts = $tag->posts()->latest()->get();
        $categories= Category::all();
        $tagar= Tag::all();
        return view('kegiatan.index', compact('posts', 'categories', 'tagar'));
    }



}
