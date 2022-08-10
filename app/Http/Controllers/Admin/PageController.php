<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePageRequest;
use App\Models\Page;

use function Termwind\render;

class PageController extends Controller
{
    public function index()
    {
        $data = [
            [
                'id' => 1,
                'title' => "Test page",
                'slug' => "slug-page",
                'content' => "lorem ipus",
            ]
        ];
        return response()->json(['data' => $data]);
    }

    /**
     * Storing Page content and It's details.
     * @param CreatePageRequest $request
     * @return void
     */
    public function store(CreatePageRequest $request)
    {
        $page = Page::create($request->validated());
        return render('admin.pages.index');
        // return view('admin.pages.index')
    }
}
