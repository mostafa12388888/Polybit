<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::limit(50)->whereJsonContains('locales', app()->getLocale())->orderBy('order')->get()->filter(fn ($faq) => $faq->answer);

        if (! $faqs->count()) {
            return redirect()->route('contact-us');
        }

        return view('faqs.index', compact('faqs'));
    }
}
