<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * عرض صفحة بدء الشات
     */
    public function start()
    {
        return view('chat.start');
    }
    
    /**
     * بدء شات جديد
     */
    public function startChat(Request $request)
    {
        $request->validate([
            'visitor_name' => 'required|string|max:255',
            'visitor_email' => 'nullable|email|max:255',
            'visitor_phone' => 'nullable|string|max:20',
            'type' => 'required|in:live_chat,leave_message',
            'initial_message' => 'required|string|max:1000',
        ]);

        $sessionId = Str::random(32);
        
        $chatRoom = ChatRoom::create([
            'visitor_name' => $request->visitor_name,
            'visitor_email' => $request->visitor_email,
            'visitor_phone' => $request->visitor_phone,
            'session_id' => $sessionId,
            'type' => $request->type,
            'initial_message' => $request->initial_message,
            'status' => 'active',
            'last_activity' => now(),
        ]);

        // إنشاء الرسالة الأولى
        ChatMessage::create([
            'chat_room_id' => $chatRoom->id,
            'sender_type' => 'visitor',
            'sender_name' => $request->visitor_name,
            'message' => $request->initial_message,
        ]);

        return response()->json([
            'success' => true,
            'chat_room_id' => $chatRoom->id,
            'session_id' => $sessionId,
            'message' => 'تم بدء الشات بنجاح'
        ]);
    }

    /**
     * إرسال رسالة من الزائر
     */
    public function sendMessage(Request $request)
    {
        try {
            \Log::info('Chat sendMessage called', [
                'request_data' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            $request->validate([
                'chat_room_id' => 'required|exists:chat_rooms,id',
                'message' => 'required|string|max:1000',
            ]);

            $chatRoom = ChatRoom::findOrFail($request->chat_room_id);
            
            if ($chatRoom->status !== 'active') {
                \Log::warning('Chat room is not active', ['chat_room_id' => $chatRoom->id, 'status' => $chatRoom->status]);
                return response()->json([
                    'success' => false,
                    'message' => 'غرفة الشات مغلقة'
                ], 400);
            }

            $message = ChatMessage::create([
                'chat_room_id' => $chatRoom->id,
                'sender_type' => 'visitor',
                'sender_name' => $chatRoom->visitor_name,
                'message' => $request->message,
            ]);

            \Log::info('Message created successfully', [
                'message_id' => $message->id,
                'chat_room_id' => $chatRoom->id,
                'message' => $request->message
            ]);

            // تحديث آخر نشاط
            $chatRoom->updateLastActivity();

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال الرسالة بنجاح'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error in sendMessage', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'خطأ في التحقق من البيانات: ' . implode(', ', collect($e->errors())->flatten()->toArray())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error in sendMessage', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ في الخادم'
            ], 500);
        }
    }

    /**
     * الحصول على رسائل غرفة شات
     */
    public function getMessages(Request $request, $chatRoomId)
    {
        $chatRoom = ChatRoom::findOrFail($chatRoomId);
        
        $messages = $chatRoom->messages()
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'chat_room' => $chatRoom
        ]);
    }

    /**
     * عرض صفحة الشات
     */
    public function show($sessionId)
    {
        $chatRoom = ChatRoom::where('session_id', $sessionId)->first();
        
        if (!$chatRoom) {
            abort(404);
        }

        return view('chat.show', compact('chatRoom'));
    }
}
