<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Notifications\NewsPublished;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        try {
            $news = News::create($request->only('title', 'full_text'));
            if ($news->save()) {
                if ((bool)$request->is_notify) {
                    $news->notify(new NewsPublished($news));
                }
            }
            $request->session()->flash('alert-success', 'Новость создана!');
            return redirect()->route('news');
        } catch (\Exception $exception) {
            $request->session()->flash('alert-error', 'Ошибка при создании новости!');
            return redirect()->route('news');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $single = News::findOrFail($id);
        return view('admin.news.edit', compact('single'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $news = News::findOrFail($id);
            $news->update($request->all());
            $request->session()->flash('alert-success', 'Новость обновлена!');
            return redirect()->route('news');
        } catch (\Exception $exception) {
            $request->session()->flash('alert-error', 'Ошибка при обновлении!');
            return redirect()->route('news');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        try {
            $news = News::findOrFail($id);
            $news->delete();
            $request->session()->flash('alert-success', 'Новость удалена!');
            return redirect()->route('news');
        } catch (\Exception $exception) {
            $request->session()->flash('alert-error', 'Ошибка при удалении!');
            return redirect()->route('news');
        }
    }
}
