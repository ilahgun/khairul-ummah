<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Post, Tag};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         "title"     => "required|unique:posts,title",
    //         "cover"     => "required",
    //         "desc"      => "required",
    //         "category"  => "required",
    //         "tags"      => "array|required",
    //         "keywords"  => "required",
    //         "meta_desc" => "required",
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }
    //     $post               = new Post();

    //     $cover              = $request->file('cover');
    //     if ($cover) {
    //         $cover_path     = $cover->store('images/blog', 'public');
    //         $post->cover    = $cover_path;
    //     }
    //     $post->title        = $request->title;
    //     $post->slug         = Str::slug($request->title);
    //     $post->user_id      = Auth::user()->id;
    //     $post->category_id  = $request->category;
    //     $post->desc         = $request->desc;
    //     $post->keywords     = $request->keywords;
    //     $post->meta_desc    = $request->meta_desc;
    //     $post->save();

    //     $post->tags()->attach($request->tags);

    //     return redirect()->route('posts.index')->with('success', 'Data added successfully');
    // }
    public function store(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        "title"     => "required|unique:posts,title",
        "cover"     => "required|image",
        "desc"      => "required",
        "category"  => "required|exists:categories,id",
        "tags"      => "array|required",
        "keywords"  => "required",
        "meta_desc" => "required",
    ]);

    // Redirect back with errors if validation fails
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Create a new post instance
    $post = new Post();
    $post->title = $request->title;
    $post->slug = Str::slug($request->title);
    $post->user_id = Auth::user()->id;
    $post->category_id = $request->category;
    $post->desc = $request->desc;
    $post->keywords = $request->keywords;
    $post->meta_desc = $request->meta_desc;

    // Handle file upload to telegrap.ph
    if ($request->hasFile('cover')) {
        $cover = $request->file('cover');
        $coverPath = $cover->getPathname();
        
        // Upload to telegrap.ph
        $client = new Client();
        $response = $client->post('https://telegra.ph/upload', [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($coverPath, 'r'),
                    'filename' => $cover->getClientOriginalName()
                ],
            ]
        ]);

        $body = json_decode($response->getBody()->getContents(), true);
        if (isset($body[0]['src'])) {
            $post->cover = 'https://telegra.ph' . $body[0]['src'];
        } else {
            return redirect()->back()
                ->withErrors(['cover' => 'Failed to upload cover image.'])
                ->withInput();
        }
    }

    // Save the post
    $post->save();

    // Attach tags
    $post->tags()->attach($request->tags);

    return redirect()->route('posts.index')->with('success', 'Data added successfully');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         "title"     => "required|unique:posts,title," . $id,
    //         "desc"      => "required",
    //         "category"  => "required",
    //         "tags"      => "array|required",
    //         "keywords"  => "required",
    //         "meta_desc" => "required",
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $post = Post::findOrFail($id);

    //     $new_cover = $request->file('cover');

    //     if ($new_cover) {
    //         if ($post->cover && file_exists(storage_path('app/public/' . $post->cover))) {
    //             Storage::delete('public/' . $post->cover);
    //         }

    //         $new_cover_path = $new_cover->store('images/blog', 'public');

    //         $post->cover = $new_cover_path;
    //     }

    //     $post->title        = $request->title;
    //     $post->slug         = $request->slug;
    //     $post->user_id      = Auth::user()->id;
    //     $post->category_id  = $request->category;
    //     $post->desc         = $request->desc;
    //     $post->keywords     = $request->keywords;
    //     $post->meta_desc    = $request->meta_desc;
    //     $post->save();

    //     $post->tags()->sync($request->tags);

    //     return redirect()->route('posts.index')->with('success', 'Data updated successfully');
    // }
    public function update(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            "title"     => "required|unique:posts,title," . $id,
            "desc"      => "required",
            "category"  => "required|exists:categories,id",
            "tags"      => "array|required",
            "keywords"  => "required",
            "meta_desc" => "required",
        ]);
    
        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Find the post or fail
        $post = Post::findOrFail($id);
    
        // Handle file upload to telegrap.ph
        $new_cover = $request->file('cover');
        if ($new_cover) {
            // Delete the old cover image if it exists
            if ($post->cover && Storage::exists('public/' . $post->cover)) {
                Storage::delete('public/' . $post->cover);
            }
    
            // Upload new cover to telegrap.ph
            $coverPath = $new_cover->getPathname();
            $client = new Client();
            $response = $client->post('https://telegra.ph/upload', [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($coverPath, 'r'),
                        'filename' => $new_cover->getClientOriginalName()
                    ],
                ]
            ]);
    
            $body = json_decode($response->getBody()->getContents(), true);
            if (isset($body[0]['src'])) {
                $post->cover = 'https://telegra.ph' . $body[0]['src'];
            } else {
                return redirect()->back()
                    ->withErrors(['cover' => 'Failed to upload cover image.'])
                    ->withInput();
            }
        }
    
        // Update other post attributes
        $post->title        = $request->title;
        $post->slug         = Str::slug($request->title);
        $post->user_id      = Auth::user()->id;
        $post->category_id  = $request->category;
        $post->desc         = $request->desc;
        $post->keywords     = $request->keywords;
        $post->meta_desc    = $request->meta_desc;
        $post->save();
    
        // Sync tags
        $post->tags()->sync($request->tags);
    
        return redirect()->route('posts.index')->with('success', 'Data updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Data moved to trash');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();

        return view('posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if ($post->trashed()) {
            $post->restore();
            return redirect()->back()->with('success', 'Data successfully restored');
        } else {
            return redirect()->back()->with('error', 'Data is not in trash');
        }
    }

    public function deletePermanent($id)
    {

        $post = Post::withTrashed()->findOrFail($id);

        if (!$post->trashed()) {

            return redirect()->back()->with('error', 'Data is not in trash');
        } else {

            $post->tags()->detach();


            if ($post->cover && file_exists(storage_path('app/public/' . $post->cover))) {
                Storage::delete('public/' . $post->cover);
            }

            $post->forceDelete();

            return redirect()->back()->with('success', 'Data deleted successfully');
        }
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;
        // mengambil data dari table pegawai sesuai pencarian data
        $posts = DB::table('posts')
            ->where('title', 'like', "%" . $cari . "%")
            ->paginate();
        // mengirim data pegawai ke view index
        return view('posts.index', compact('posts'));
    }
}
