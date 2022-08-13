<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;

class PageController extends Controller
{

    /**
     * Getting All Pages with parent and childs relationship.
     *
     * @return void
     */
    public function index()
    {
        $pages = Page::with(['children', 'parent'])->get();
        return response()->json(['data' => $pages, "success" => true, "message" => "Pages retrived."], 200);
    }

    /**
     * Storing Page content and It's details.
     * @param CreatePageRequest $request
     * @return void
     */
    public function store(CreatePageRequest $request)
    {
        $page = Page::create($request->validated());
        return response()->json(['data' => $page, 'success' => true, "message" => "Page has been successfully created."], 201);
    }

    /**
     * Showing Current page details by slug
     *
     * @param Page $page
     * @return void
     */
    public function show(Page $page)
    {
        return response()->json(['data' => $page, 'success' => true], 200);
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
        if (!isset($page)) {
            return response()->json(['data' => null, 'success' => false, 'message' => "Page not found."], 200);
        } else {
            $page->update($request->validated());
            return response()->json(['data' => $page, 'success' => true, 'message' => "Page details has been updated."], 200);
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
         * Update child pages as well and update it's parent id to null.
         */
        $childPage = Page::where('parent_id', $page->id)->get();
        $ids = array_values(collect($childPage)->pluck('id')->all());
        \DB::table('pages')->whereIn('id', $ids)->update(['parent_id' => null]);
        $page->delete();
        return response()->json(['data' => null, 'success' => true, 'message' => "Page details has been deleted."]);
    }
}
