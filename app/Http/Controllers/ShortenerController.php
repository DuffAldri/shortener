<?php

namespace App\Http\Controllers;

use App\Models\Shortener;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{
    public function index($slug = null)
    {
        return view('shortener', [
        "title" => "Shortener",
        "slug" => $slug,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required|unique:shortener,slug|max:25|',
            'link' => 'required|unique:shortener,slug|',
        ]);

        $shortener = Shortener::create([
            'slug' => $request->slug,
            'link' => $request->link,
        ]);

        $link = $request->slug;
        return redirect()->route('shortener', $link);
    }

    public function show($slug)
    {
        // $shortener = Shortener::findOrFail($slug);
        $shortener = Shortener::where('slug', $slug)->first();

        if(!$shortener) return redirect()->route('notfound');

        if(str_starts_with($shortener->link, 'http://') || str_starts_with($shortener->link, 'https://'))
            $link = $shortener->link;
        else $link = 'http://' . $shortener->link;
        return redirect($link);
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {
        
    }

}
