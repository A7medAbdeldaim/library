<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function abort;
use function redirect;
use function view;

class TeachersController extends Controller {
    public function index() {
        $users = Teacher::all();
        return view('admin.Teachers.teachers', ['users' => $users]);
    }

    public function create() {
        $books = Book::all();
        return view('admin.Teachers.add_teacher', compact('books'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'book_id' => 'required|integer|exists:books,id',
            'password' => 'required|string|max:255|confirmed',
        ]);

        $pass = Hash::make($request->get('password'));
        $request = $request->except('password', '_token');

         Teacher::create($request + ['password' => $pass]);

        return redirect()->route('admin.teachers')->with(['status' => 'success', 'message' => 'Teacher Added Successfully']);
    }

    public function edit($id){
        $books = Book::all();
        $user = Teacher::find($id);
        return view('admin.Teachers.edit_teacher', compact('user', 'books'));
    }

    public function update(Request $request, $id) {
        $user = Teacher::find($id);

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string',
            'book_id' => 'required|integer|exists:books,id',
            'password' => 'required|string|max:255|confirmed',
        ]);

        $pass = Hash::make($request->get('password'));
        $request = $request->except('password', '_token');

        $user->update($request + ['password' => $pass]);

        return redirect()->route('admin.teachers')->with(['status' => 'success', 'message' => 'Teacher Edited Successfully']);
    }

    public function destroy($id) {
        $user = Teacher::find($id);

        if (!$user) {
            abort(404);
        }
        $user->delete();

        return redirect()->route('admin.teachers')->with(['status' => 'success', 'message' => 'Teacher Deleted Successfully']);
    }
}
