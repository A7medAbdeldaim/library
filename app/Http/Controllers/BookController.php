<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\Book;
use App\Models\BorrowRequest;
use App\Models\BuyBook;
use App\Models\Conversation;
use App\Models\RequestBook;
use App\Models\StudentMessage;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class BookController extends Controller
{
    public function show($id)
    {
        $book = Book::find($id);
        $teacher = Teacher::where('book_id', $book->id)->first();
        return view('book', compact('book', 'teacher'));
    }

    public function request_book(Request $request, $id): RedirectResponse
    {
        RequestBook::create([
            'book_id' => $id,
            'student_id' => auth('users')->id(),
        ]);
        return redirect()->route('books.show')->with(['status' => 'success', 'message' => 'Done Successfully']);
    }

    public function rent_book(Request $request, $id): RedirectResponse
    {
        BorrowRequest::create([
            'borrow_from' => $request->borrow_from,
            'borrow_to' => $request->borrow_to,
            'book_id' => $id,
            'student_id' => auth('users')->id(),
        ]);
        return redirect()->route('books.show')->with(['status' => 'success', 'message' => 'Done Successfully']);
    }

    public function buy_book(Request $request, $id): RedirectResponse
    {
        $book = Book::find($id);
        $book->update(['stock' => ($book->stock - 1)]);
        BuyBook::create([
            'book_id' => $id,
            'student_id' => auth('users')->id(),
        ]);
        return redirect()->route('books.show')->with(['status' => 'success', 'message' => 'Done Successfully']);
    }


    public function chat()
    {
        $conversation_id = request()->get('conversation_id') ?? null;

        $user = auth('users')->user();
        $conversations = Conversation::whereHas('user_messages', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get();

        if (!$conversation_id) {
            $conversation_id = $conversations->first()->id ?? null;
        }
        $messages = StudentMessage::where('user_id', $user->id)->where('conversation_id', $conversation_id)->get();
        if ($messages->count()) {
            $trainer_messages = TrainerMessage::where('conversation_id', $conversation_id)->get();

            $messages = $messages->merge($trainer_messages)->sortBy('created_at');
        }
        $conversation = Conversation::find($conversation_id);
        $trainer_id = $conversation->trainer_id;

        return view('chat', compact('conversations', 'messages', 'trainer_id'));
    }

    public function send_message($target_id, Request $request)
    {
        $user = auth('users')->user();
        $request->validate([
            'message' => 'required|string',
        ]);

        $conversation = Conversation::where([
            'user_id' => $user->id,
            'teacher_id' => $target_id,
        ])->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_id' => $user->id,
                'teacher_id' => $target_id,
            ]);
        }
        $message = StudentMessage::create([
            'user_id' => $user->id,
            'conversation_id' => $conversation->id,
            'message' => $request->message,
        ]);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Done Successfully']);
    }
}
