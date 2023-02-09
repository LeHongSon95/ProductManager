<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class LanguageController extends Controller
{
    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @param mixed $locale
     * @return \Illuminate\Http\RedirectResponse
     * 
     */

    public function index(Request $request, $locale)
    {
        if (!in_array($locale, ['en', 'vi'])) {
            $request->session()->put(['lang' => $locale]);
            abort(404);
        }
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
