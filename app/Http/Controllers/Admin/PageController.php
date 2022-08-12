<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with(['children', 'parent'])->get();
        return response()->json([
            'data' => $pages,
            "success" => true,
            "message" => "Pages retrived."
        ]);
    }

    public function getPageBySearch()
    {
        $pages = Page::where('name', 'LIKE', '%{$search}%');

        return response()->json(['data' => $pages]);
    }

    /**
     * Storing Page content and It's details.
     * @param CreatePageRequest $request
     * @return void
     */
    public function store(CreatePageRequest $request)
    {
        $page = Page::create($request->validated());
        return response()->json([
            'data' =>  $page,
            'success' => true,
            "message" => "Page has been successfully created."
        ]);
        // return view('admin.pages.index')
    }

    public function show(Page $page)
    {
        return response()->json([
            'data' => $page,
            'success' => true
        ]);
    }

    /**
     * Updating the page.
     *
     * @param Page $page
     * @param UpdatePageRequest $request
     * @return void
     */
    public function update(Page $page, UpdatePageRequest $request)
    {
        // $page = Page::where('id', $page->id);
        if (!isset($page)) {
            return response()->json([
                'data' => null,
                'success' => false,
                'message' => "Page not found."
            ]);
        } else {
            $page->update($request->validated());
            return response()->json([
                'data' => $page,
                'success' => true,
                'message' => "Page details has been updated."
            ]);
        }
    }


    /**
     * Delete Page details
     *
     * @param Page $page
     * @return void
     */
    public function destroy(Page $page)
    {
        /**
         * Update child pages parent id to null
         */
        $childPage = Page::where('parent_id', $page->id)->get();
        $ids = array_values(collect($childPage)->pluck('id')->all());
        // Page::whereIn('id', $ids)->update('parent_id', null);
        \DB::table('pages')->whereIn('id', $ids)->update(['parent_id' => null]);

        $page->delete();
        return response()->json([
            'data' => null,
            'success' => true,
            'message' => "Page details has been deleted."
        ]);
    }
}
