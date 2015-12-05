<?php
/**
 * Created by PhpStorm.
 * User: WenPinGao
 * Date: 2015/5/16
 * Time: 14:36
 */

namespace Home\Model;


use Think\Model;

class Content extends Model{
    protected $trueTableName = 'content';

    //添加一条Message
    public function addMessage($userId,$friendId,$message){
        $date = new \DateTime();
        $dateTime =  $date->format('Y-m-d H:i:s');

        $data = array(
            'content_sender_id' => $userId,
            'content_Receiver_id' => $friendId,
            'content_message' => $message,
            'content_time' => $dateTime,
            'content_state' => 0
        );

        $contentId = $this->add($data);
        if($contentId >= 1){
            return true;
        }else{
            return false;
        }
    }
    //获取信息
    public function getFriendsMessages($userId){
        $sql = "select u1.user_id,u2.user_id,u2.user_name,c.content_message,c.content_time from users u1 join content c on u1.user_id = c.content_sender_id join users u2 on c.content_Receiver_id = u2.user_id where u2.user_id = $userId and c.content_state = 0 order by u2.user_id;";
        $messgaes = $this->query($sql);
        return $messgaes;
    }

    //更改信息状态
    public function gaiBianState($userId){
        $data = array('content_state' => 1);
        $this->where("content_Receiver_id = $userId and content_state = 0")->save($data);
    }
}