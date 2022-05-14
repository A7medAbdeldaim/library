<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\BorrowRequest;
use App\Models\BuyBook;
use App\Models\Conversation;
use App\Models\RequestBook;
use App\Models\StudentMessage;
use App\Models\TeacherMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function abort;
use function redirect;
use function view;

class MessagesController extends Controller {
    public function index(Request $request) {
        $messages = Conversation::where('teacher_id', auth('teachers')->user()->id)->get();

        return view('teacher.messages', ['messages' => $messages]);
    }

    public function show_message(Request $request) {
        if ($request->has('con_id')) {
            $con_id = $request->con_id;
            $message = StudentMessage::where('conversation_id', $con_id)->get();
            if ($message->count()) {
                $teacher_messages = TeacherMessage::where('conversation_id', $con_id)->get();

                $message = $message->merge($teacher_messages)->sortBy('created_at');
            }
        } else {
            $message = null;
        }
        return view('teacher.show_messages', ['message' => $message]);
    }
}
