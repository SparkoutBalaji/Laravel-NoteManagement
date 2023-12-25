<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $user = User::find($id);
        $userCategories = $user->category;
        return view('user.createOrEdit', compact('user', 'userCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'tags' => 'required|array',
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            // Handle validation failure
            return back()->withErrors($validator)->withInput();
        }

        // Check if the tags array is not empty
        $tags = !empty($request->tags) ? json_encode($request->tags) : '';

        // Check if a note with the same category already exists for the user
        $existingNote = Note::find($request->input('note_id'));

        if ($existingNote) {
            // Update the existing note
            $existingNote->update([
                'category' => $request->input('category'),
                'tags' => $tags,
                'note' => $request->input('note'),
            ]);

            Session::flash('message', 'Note updated successfully.');
        } else {
            // Create a new note
            Note::create([
                'user_id' => $id,
                'category' => $request->input('category'),
                'tags' => $tags,
                'note' => $request->input('note'),
            ]);

            Session::flash('message', 'Note submitted successfully.');
        }

        return redirect()->route('notes.list', ['id' => $id]);
    }



    // public function upload(Request $request)
    //     {
    //         if ($request->hasFile('upload')) {

    //         $originName = $request->file('upload')->getClientOriginalName();

    //         $fileName = pathinfo($originName, PATHINFO_FILENAME);

    //         $extension = $request->file('upload')->getClientOriginalExtension();

    //         $fileName = $fileName . '_' . time() . '.' . $extension;



    //         $request->file('upload')->move(public_path('uploads'), $fileName);

    //         $url = asset('uploads/' . $fileName);

    //         return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

    //     }

    // }



    /**
     * Display the specified resource.
     */
    public function show($id, Note $note)
    {
        $user = User::find($id);
        $userCategories = $user->category;

        $note = Note::findOrFail($note);
        return view('user.show', compact('note', 'user', 'userCategories'));
    }

    public function list($id)
    {
        $user = User::find($id);
        $userCategories = $user->category;
        $userNotes = $user->notes;

        return view('user.list', compact('user', 'userCategories', 'userNotes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Note $note)
    {
        $userCategories = $user->category;
        return view('user.createOrEdit', compact('user', 'userCategories', 'note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, Note $note)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'tags' => 'required|array',
            'notes' => 'required',
        ]);

        $note->update([
            'category' => $validatedData['category'],
            'tags' => json_encode($validatedData['tags']),
            'notes' => $validatedData['notes'],
        ]);

        // $user = User::find($id);
        // $userCategories = $user->categories;
        // $userNotes = $user->notes;


        return redirect()->route('notes.list', ['id' => $id])
            ->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(User $user, Note $note)
    // {
    //     $note = Note::findOrFail($note);
    //     $note->delete();

    //     $user = User::find($user);
    //     $userCategories = $user->category;

    //     return redirect()->route('notes.list', compact('user', 'userCategories'))->with('success', 'Note deleted successfully');
    // }
    public function destroy(Request $request)
    {
        // dd($request->all());
        Note::where('id', $request->input('Note'))->delete();
        $id = $request->input('id');

        // Assuming you want to redirect to the notes list
        return redirect()->route('notes.list', ['id' => $id])->with('success', 'Note deleted successfully');
    }
}
