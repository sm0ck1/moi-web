<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function show($page, Request $request)
    {
        $isAmp = last($request->segments()) == 'amp';

        $pages = [
            'terms' => [
                'title' => 'Terms of Use',
                'description' => 'Terms and conditions for using our news portal',
                'content' => view('static.terms')->render(),
            ],
            'privacy' => [
                'title' => 'Privacy Policy',
                'description' => 'How we collect, use, and protect your personal information',
                'content' => view('static.privacy')->render(),
            ],
            'contact' => [
                'title' => 'Contact Us',
                'description' => 'Get in touch with our news team',
                'content' => view('static.contact')->render(),
            ],
            'about' => [
                'title' => 'About Our News Portal',
                'description' => 'Our mission, values, and journalistic approach',
                'content' => view('static.about')->render(),
            ],
        ];

        abort_if(! isset($pages[$page]), 404);

        return view($isAmp ? 'templates.amp.static' : 'templates.static', [
            'page' => $pages[$page],
            'content' => Str::markdown($pages[$page]['content']),
        ]);
    }
}
