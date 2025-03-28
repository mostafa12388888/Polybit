<?php

namespace App\Http\Controllers;

use App\Models\Catalog;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogs = Catalog::latest()->whereJsonContains('locales', app()->getLocale())
            ->with('media')->paginate(10);

        return view('catalogs.index', compact('catalogs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalog $catalog)
    {
        if (! $catalog->translated()) {
            return redirect()->route('catalogs.index');
        }

        $catalog->loadMissing('media');

        return view('catalogs.show', compact('catalog'));
    }
}
