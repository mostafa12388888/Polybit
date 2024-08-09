<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }
}
