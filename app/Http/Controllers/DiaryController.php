<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $diaries = Diary::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('location', 'like', '%' . $keyword . '%')
                    ->orWhere('body', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->get();

    return view('diaries.index', compact('diaries', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('diaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'travel_date' => 'required|date',
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'location' => $request->location,
            'travel_date' => $request->travel_date,
            'body' => $request->body,
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('diaries', 'public');
        }

        Diary::create($data);

        return redirect()->route('diaries.index')
            ->with('success', '旅行日記を投稿しました！');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Diary $diary)
    {
        return view('diaries.show', compact('diary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diary $diary)
    {
        return view('diaries.edit', compact('diary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diary $diary)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'travel_date' => 'required|date',
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'location' => $request->location,
            'travel_date' => $request->travel_date,
            'body' => $request->body,
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('diaries', 'public');
        }

        $diary->update($data);

        return redirect()->route('diaries.show', $diary)
            ->with('success', '旅行日記を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diary $diary)
    {
        $diary->delete();

        return redirect()->route('diaries.index')
            ->with('success', '旅行日記を削除しました！');
    }
}
