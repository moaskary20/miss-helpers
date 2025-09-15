<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * عرض قائمة غرف الشات
     */
    public function index()
    {
        $chatRooms = ChatRoom::with(['messages' => function($query) {
            $query->latest();
        }])
        ->withCount(['messages'])
        ->orderBy('last_activity', 'desc')
        ->paginate(15);
        
        return view('admin.chat.index', compact('chatRooms'));
    }

    /**
     * عرض غرفة شات محددة
     */
    public function show(string $id)
    {
        $chatRoom = ChatRoom::with(['messages' => function($query) {
            $query->orderBy('created_at', 'asc');
        }])->findOrFail($id);
        
        // تحديث آخر نشاط
        $chatRoom->updateLastActivity();
        
        return view('admin.chat.show', compact('chatRoom'));
    }

    /**
     * إرسال رسالة من المدير
     */
    public function sendMessage(Request $request, string $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $chatRoom = ChatRoom::findOrFail($id);
        
        ChatMessage::create([
            'chat_room_id' => $chatRoom->id,
            'sender_type' => 'admin',
            'sender_name' => 'المدير',
            'message' => $request->message,
        ]);

        // تحديث آخر نشاط
        $chatRoom->updateLastActivity();

        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح');
    }

    /**
     * إغلاق غرفة شات
     */
    public function closeChat(string $id)
    {
        $chatRoom = ChatRoom::findOrFail($id);
        $chatRoom->update(['status' => 'closed']);

        return redirect()->route('admin.chat.index')->with('success', 'تم إغلاق غرفة الشات بنجاح');
    }

    /**
     * إعادة فتح غرفة شات
     */
    public function reopenChat(string $id)
    {
        $chatRoom = ChatRoom::findOrFail($id);
        $chatRoom->update(['status' => 'active']);

        return redirect()->back()->with('success', 'تم إعادة فتح غرفة الشات بنجاح');
    }

    /**
     * حذف غرفة شات
     */
    public function destroy(string $id)
    {
        $chatRoom = ChatRoom::findOrFail($id);
        $chatRoom->delete();

        return redirect()->route('admin.chat.index')->with('success', 'تم حذف غرفة الشات بنجاح');
    }

    /**
     * تحديث حالة القراءة
     */
    public function markAsRead(string $id)
    {
        $chatRoom = ChatRoom::findOrFail($id);
        $chatRoom->messages()->where('sender_type', 'visitor')->update([
            'is_read' => true,
            'read_at' => now()
        ]);
        
        $chatRoom->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * الحصول على عدد الرسائل غير المقروءة
     */
    public function getUnreadCount()
    {
        $unreadCount = ChatMessage::where('sender_type', 'visitor')
            ->where('is_read', false)
            ->count();

        return response()->json([
            'success' => true,
            'count' => $unreadCount
        ]);
    }
}
