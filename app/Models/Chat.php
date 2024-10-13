<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    protected $fillable = [
        'form_id',
        'to_id',
        'message',
    ];

    private static $USER_CHAT = 0;
    private static $ADMIN_CHAT = 1;


    private static function getFloatRight($chat, $userID, $type)
    {
        // nếu người dùng user và admin gửi thì nội dụng message => 'to-right
        if (($chat->from_id == $userID && $type == self::$USER_CHAT) || ($chat->from_id == 1 && $type == self::$ADMIN_CHAT)) return 'to-right';
        return '';
    }


    // nhận vào User or Admin
    public static function getSrcAvatar($type)
    {
        if ($type == self::$USER_CHAT) {
            return url('users/img/admin.png'); //  url = public
        } else {
            return url('admins/img/user.png'); // Avatar của user
        }
        return '';
    }

    private static function generatorChatHTML($chats, $userID, $type)
    {
        if (!$chats) {   
            return '<h6 style="text-align: center; margin-top: 140px;">Không có tin nhắn.</h6>';
        }
             
        $infoMessage = '';
        foreach ($chats as $chat) {
            $floatRight = self::getFloatRight($chat, $userID, $type);
            $srcAvatar = self::getSrcAvatar($type);
            
            $infoMessage .= '
                        <div class="box-mess ' . $floatRight . '">
                            <div class="box-image">
                                <img class="img-user"  src="' . $srcAvatar . '" alt="">
                            </div>
                            <div class="mess-content">
                                <p>' . $chat->message . '</p>
                            </div>
                        </div>
                    ';
        }

        return $infoMessage;
    }


    // có chức năng lấy tất cả tin nhắn giữa người dùng hiện tại và admin
    public static function getUserChat()
    {
        $userID = Auth::user()->id;
        $chats = Chat::where([
            'from_id' => $userID,  // Lấy các tin nhắn mà người dùng (from_id) gửi đến admin 
            'to_id' => 1,  // Lấy các tin nhắn mà admin gửi đến người dùng.
        ])->orWhere([   //  Nếu một trong hai điều kiện trên thỏa mãn, tin nhắn sẽ được lấy.
            'from_id' => 1,
            'to_id' => $userID,
        ])->get();

        return self::generatorChatHTML($chats, $userID, self::$USER_CHAT);
    }


    public static function getAdminChat($userID)
    {
        $chats = Chat::where([
            'from_id' => 1,
            'to_id' =>  $userID,
        ])->orWhere([
            'from_id' => $userID,
            'to_id' => 1,
        ])->get();

        return self::generatorChatHTML($chats, $userID, self::$ADMIN_CHAT);
    }
}
