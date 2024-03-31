<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotesController extends Controller
{
    public function index(Notes $note, Request $request)
    {
        $data = $note->where('id_user', Auth::user()->id)
            ->when(request('search-input'), function ($query, $search) {
                return $query->search($search);
            })
            ->latest()
            ->get();
        // Dalam kode di atas, when() digunakan untuk mengecek apakah parameter pencarian (search) diberikan dalam request. Jika ya, maka kondisi pencarian akan ditambahkan ke query. Jika tidak, query akan tetap sama seperti sebelumnya.
        return view('user.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('user.crnote');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required'],
            'note' => ['required'],
        ]);

        // id user lagi login
        $validated['id_user'] = Auth::user()->id;

        if ($validated) {
            if (Notes::create($validated)) {
                return redirect()->route('index')->with('notification', [
                    'message' => 'Success Added',
                    'bg-color' => 'linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(153,222,29,1) 0%, rgba(0,212,255,1) 80%)'
                ]);
            }
        }
    }

    public function update(Request $request, Notes $notes)
    {
        $id = $request->updateid;
        if ($id) {
            $validated = $request->validate([
                'judul' => ['required'],
                'note' => ['required'],
            ]);

            $validated['id_user'] = Auth::user()->id;

            $notes = Notes::where('id', $id)->first(); // Gantilah YourModel dengan model yang sesuai

            if ($notes) {
                if ($notes->update($validated)) {
                    return redirect()->route('index')->with('notification', [
                        'message' => 'Success Updated',
                        'bg-color' => 'linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(153,222,29,1) 0%, rgba(0,212,255,1) 80%)'
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Some Errors');
                }
            } else {
                // Handle jika catatan tidak ditemukan
                return redirect()->back()->with('error', 'Note not found.');
            }
        }
    }

    public function destroy(Notes $notes, Request $request)
    {
        $destroy = $notes->findOrFail($request->id);

        if ($destroy) {
            $destroy->delete();
            return redirect()->route('index')->with('notification', [
                'message' => 'Success Deleted',
                'bg-color' => 'linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(153,222,29,1) 0%, rgba(0,212,255,1) 80%)'
            ]);
        }
    }
}
