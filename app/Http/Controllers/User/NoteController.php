<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function create()
    {
        $user = Auth::guard('users')->user();
        $userCategories = $user->category;
        return view('user.createOrEdit', compact('user', 'userCategories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = $request->validate([
            'category' => 'required',
            'tags' => 'required',
            'note' => 'required',
        ]);

        $tags = !empty($request->tags) ? json_encode($request->tags) : '';


        $existingNote = Note::find($request->input('note_id'));

        if ($existingNote) {
            $existingNote->update([
                'category' => $request->input('category'),
                'tags' => $request->input('tags'),
                'note' => $request->input('note'),
            ]);

            Session::flash('message', 'Note updated successfully.');
        } else {
            Note::create([
                'user_id' => Auth::guard('users')->user()->id,
                'category' => $request->input('category'),
                'tags' => $tags,
                'note' => $request->input('note'),
            ]);

            Session::flash('message', 'Note submitted successfully.');
        }
        return redirect()->route('notes.list');
    }

    public function list()
    {
        $user = Auth::user();
        $userCategories = $user->category;
        $userNotes = $user->notes;

        return view('user.list', compact('user', 'userCategories', 'userNotes'));
    }

    public function category()
    {
        // dd(request('category'));
        $user = Auth::user();
        $userCategories = $user->category;
        $userNotes = $user->notes;
        $categoryName = request('category');

        $category = Note::where('category', $categoryName)->get();

        return view('user.categoryList', compact('user', 'userCategories', 'categoryName', 'userNotes', 'category'));
    }



    public function edit()
    {
        $user = Auth::user();
        $noteId = request('note');
        $note = Note::find($noteId);
        $userCategories = $user->category;

        return view('user.createOrEdit', compact('user', 'userCategories', 'note'));
    }


    public function destroy()
    {
        Note::where('id', request('note'))->delete();
        return redirect()->route('notes.list')->with('success', 'Note deleted successfully');
    }
}
