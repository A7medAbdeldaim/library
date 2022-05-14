<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function abort;
use function redirect;
use function view;

class MagazinesController extends Controller {
    public function index() {
        $magazines = Book::where('type', 'magazine')->get();
        return view('admin.Magazines.magazines', ['books' => $magazines]);
    }

    public function create() {
        $libraries = Library::all();
        return view('admin.Magazines.add_magazine', compact('libraries'));
    }

    public function store(Request $request) {
        $request->validate([
            'name_en' => 'required|string',
            'description_en' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'library_id' => 'required|integer|exists:libraries,id',
        ]);

        if ($request->has('image')) {
            $fileName = $this->uploadImage($request->image);
        }

        $request = $request->except('_token', 'image');

         Book::create($request + ['image' => $fileName ?? null, 'type' => 'magazine']);

        return redirect()->route('admin.magazines')->with(['status' => 'success', 'message' => 'Magazine Added Successfully']);
    }

    public function edit($id){
        $libraries = Library::all();
        $book = Book::find($id);
        return view('admin.Magazines.edit_magazine', compact('book', 'libraries'));
    }

    public function update(Request $request, $id) {
        $magazine = Book::find($id);

        if (!$magazine) {
            abort(404);
        }

        $request->validate([
            'name_en' => 'required|string',
            'description_en' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'library_id' => 'required|integer|exists:libraries,id',
        ]);

        if ($request->has('image')) {
            $fileName = $this->uploadImage($request->image);
        }

        $request = $request->except('_token', 'image');

        $magazine->update($request + ['image' => $fileName ?? $magazine->image]);

        return redirect()->route('admin.magazines')->with(['status' => 'success', 'message' => 'Magazine Edited Successfully']);
    }

    public function destroy($id) {
        $magazine = Book::find($id);

        if (!$magazine) {
            abort(404);
        }
        $magazine->delete();

        return redirect()->route('admin.magazines')->with(['status' => 'success', 'message' => 'Magazine Deleted Successfully']);
    }

    public function uploadImage($file) {
        $extension = '.' . $file->extension();
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = str_replace(' ', '-', $fileName);
        $fileName = str_replace('_', '-', $fileName);
        $fileName = str_replace('+', '-', $fileName);

        $fileName .= '-' . base_convert(microtime(true) * 10000, 10, 32);

        $fileName .= $extension != '.' ? $extension : '';
        Storage::putFileAs('/', $file, $fileName);

        return $fileName;
    }
}
