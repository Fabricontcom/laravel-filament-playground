<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\App;

class PostController extends Controller
{
    public function show($locale, string $id)
    {
        return view('single', [
            'post' => Post::findOrFail($id)
        ]);
    }

    public function changeLocale(Request $request, $locale)
    {
        $request->session()->put('locale', $locale);
        return redirect()->back();
    }
}
