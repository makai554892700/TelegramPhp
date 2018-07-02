<?php

namespace App\Utils;

class TelegramUtils
{
    //创建静态私有的变量保存该类对象
    private static $instance;
    private $MadelineProto;

    //防止直接创建对象
    private function __construct()
    {
        echo "TelegramUtils ready to inited.\n";
        $this->MadelineProto = new \danog\MadelineProto\API('/tmp/session.madeline'
            , ['app_info' => ['api_id' => 0, 'api_hash' => '']
                , 'updates' => ['handle_updates' => false]]);
        echo "TelegramUtils is running.\n";
        $this->MadelineProto->start();
        echo "TelegramUtils is inited.\n";
    }

    //防止克隆对象
    private function __clone()
    {
    }

    static public function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function printArray($input, $level)
    {
        $left = "+";
        for ($i = 0; $i < $level; $i++) {
            $left .= $left;
        }
        $keys = array_keys($input);
        foreach ($keys as $key) {
            $value = $input[$key];
            if (is_array($value)) {
                $this->printArray($value, $level + 1);
            } else {
                \danog\MadelineProto\Logger::log($left . 'key=' . $key . ';value=' . $value);
            }
        }
    }

    //发送消息
    public function sendMessage($username, $message)
    {
        return $this->MadelineProto->messages->sendMessage(['peer' => $username, 'message' => $message]);
    }

    //添加群组
    public function intoGroup($groupLink)
    {
        return $this->MadelineProto->channels->joinChannel(['channel' => $groupLink]);
    }

    // 根据关键字过滤已有联系人
    public function searchContact($search, $limit)
    {
        return $this->MadelineProto->contacts->search(['q' => $search, 'limit' => $limit])['users'];
    }

    // 根据用户唯一值获取用户详细信息 yes
    public function getUserMessage($username)
    {
        $full_chat = $this->MadelineProto->get_full_info($username);
        \danog\MadelineProto\Logger::log('----------------------');
        //    var_dump($full_chat);
        $this->printArray($full_chat, 0);
        \danog\MadelineProto\Logger::log('----------------------');

    }

    //检查电话号码是否激活 yes
    public function checkPhone($phoneNumber)
    {
        $test = $this->MadelineProto->auth->checkPhone(['phone_number' => $phoneNumber]);
        var_dump($test);
    }

    //获取当前用户群聊天列表 yes
    public function getGroupList()
    {

        $test = $this->MadelineProto->messages->getAllChats(['except_ids' => [0]]);
//        $test = $this->MadelineProto->get_pwr_chat('chat#244108863');
//        $test = $this->MadelineProto->get_full_info('chat#244108863');

//        $test = $this->MadelineProto->get_pwr_chat('@MadelineProtoIta');
//        $test = $this->MadelineProto->get_pwr_chat('channel#1115554076');
//        $test = $this->MadelineProto->get_full_info('channel#1115554076');
//        $test = $this->MadelineProto->get_info('channel#1115554076');
        $this->printArray($test, 0);
//        $chats = $test['chats'];
//        foreach ($chats as $chat) {
//            \danog\MadelineProto\Logger::log('----------------------');
//            //        var_dump($chat);
//            \danog\MadelineProto\Logger::log('id=' . $chat['id']);
//            if (array_key_exists('access_hash', $chat)) {
//                \danog\MadelineProto\Logger::log('access_hash=' . $chat['access_hash']);
//                \danog\MadelineProto\Logger::log(json_encode($chat['access_hash']));
//            } else {
//                \danog\MadelineProto\Logger::log('access_hash=' . 'null');
//            }
//            if (array_key_exists('username', $chat)) {
//                \danog\MadelineProto\Logger::log('username=' . $chat['username']);
//            } else {
//                \danog\MadelineProto\Logger::log('username=' . 'null');
//            }
//            \danog\MadelineProto\Logger::log('title=' . $chat['title']);
//            \danog\MadelineProto\Logger::log('----------------------');
//        }
    }

    // 根据已加入群组获取群组成员列表信息 yes
    public function getUserListByGroupLink($groupLink)
    {
//        $InputChannel = '@username'; // Username
//        $InputChannel = 'me'; // The currently logged-in user
//        $InputChannel = 44700; // bot API id (users)
//        $InputChannel = -492772765; // bot API id (chats)
//        $InputChannel = -10038575794; // bot API id (channels)
//        $InputChannel = 'https://t.me/danogentili'; // t.me URLs
//        $InputChannel = 'https://t.me/joinchat/asfln1-21fa_'; // t.me invite links
//        $InputChannel = 'user#44700'; // tg-cli style id (users)
//        $InputChannel = 'chat#492772765'; // tg-cli style id (chats)
//        $InputChannel = 'channel#38575794'; // tg-cli style id (channels)

        $users = $this->MadelineProto->get_pwr_chat($groupLink);
        \danog\MadelineProto\Logger::log('----------------------');
        $participants = $users['participants'];
        foreach ($participants as $participant) {
            \danog\MadelineProto\Logger::log('----------------------');
            \danog\MadelineProto\Logger::log(';id=' . $participant['user']['id']);
            \danog\MadelineProto\Logger::log(';type=' . $participant['user']['type']);
            if (array_key_exists('username', $participant['user'])) {
                \danog\MadelineProto\Logger::log(';username=' . $participant['user']['username']);
            } else {
                \danog\MadelineProto\Logger::log('username=' . 'null');
            }
            \danog\MadelineProto\Logger::log('----------------------');
        }
        \danog\MadelineProto\Logger::log('----------------------');
    }

}
