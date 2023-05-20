<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Page::when($request->has("s"), function ($q) use ($request) {
            return $q->where("title", "like", "%" . $request->get("s") . "%");
        })->latest()->paginate(10);

        return view('admin.pages.index', compact('pages'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'Please choose title.',
            'description.required' => 'Please enter page description'
        ]);

        $str = strtolower($request->get('title'));
        $slug = preg_replace('/\s+/', '-', $str);
        $request->merge(['slug' => $slug]);
        $count = Page::where('slug', '=', $request->get('slug'))->count();
        if ($count > 0) {
            return redirect()->back()
                ->with('error', 'Page is already exist.');
        }
        Page::create($request->all());

        return redirect()->route('pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'Please choose title.',
            'description.required' => 'Please enter page description'
        ]);
        $page->updated_at  = date('Y-m-d G:i:s');
        $str = strtolower($request->get('title'));
        $slug = preg_replace('/\s+/', '-', $str);
        $request->merge(['slug' => $slug]);
        $count = Page::where('slug', '=', $request->get('slug'))->where('id', '!=', $page->id)->count();
        if ($count > 0) {
            return redirect()->back()
                ->with('error', 'Page is already exist.');
        }
        $page->update($request->all());

        return redirect()->route('pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
