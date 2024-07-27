<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = 'http://127.0.0.1/blog-app/public/api/posts';
        $response = $client->request('GET', $url);

        $postsContent = $response->getBody()->getContents();
        $contentArray = json_decode($postsContent, true);

        $posts = $contentArray['data'];

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $content = $request->content;

        $parameter = [
            'title' => $title,
            'content' => $content,
        ];


        $client = new Client();
        $url = 'http://127.0.0.1/blog-app/public/api/posts';
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);

        $postContent = $response->getBody()->getContents();
        $contentArray = json_decode($postContent, true);

        if ($contentArray['success'] == true) {
            return redirect()->to('posts')->with('success', 'Berhasil membuat postingan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1/blog-app/public/api/post/$id";
        $response = $client->request('GET', $url);

        $postsContent = $response->getBody()->getContents();
        $contentArray = json_decode($postsContent, true);

        $post = $contentArray['data'];
        return view('posts.index', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $title = $request->title;
        $content = $request->content;

        $parameter = [
            'title' => $title,
            'content' => $content,
        ];


        $client = new Client();
        $url = "http://127.0.0.1/blog-app/public/api/post/$id";
        $response = $client->request('PATCH', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);

        $postContent = $response->getBody()->getContents();
        $contentArray = json_decode($postContent, true);

        if ($contentArray['success'] == true) {
            return redirect()->to('posts')->with('success', 'Berhasil mengedit postingan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1/blog-app/public/api/post/$id";
        $response = $client->request('DELETE', $url);

        $postContent = $response->getBody()->getContents();
        $contentArray = json_decode($postContent, true);

        if ($contentArray['success'] == true) {
            return redirect()->to('posts')->with('success', 'Berhasil menghapus postingan');
        }
    }
}
