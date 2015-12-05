<?php
/**
 * Created by PhpStorm.
 * User: WenPinGao
 * Date: 2015/5/14
 * Time: 22:57
 */

namespace Home\Model;


use Think\Model;

class Friends extends Model {

    protected $trueTableName = 'friends';

    //�ж��Ƿ��Ѿ��Ǻ���
    public function isFriend($userId,$friendId){
        $friendInfo = $this->where("user_id = '$userId' and friend_user_id = '$friendId'")->select();
        if(count($friendInfo) >= 1 ){
            return true;//�Ѿ��Ǻ�����
        }else{
            return false;//�����Ǻ���
        }
    }

    //��Ӻ���
    public function addFriend($userId,$friendId,$friendName){
        $today = date("Y-m-d");

        $data = array(
            'user_id' => $userId,
            'friend_user_id' => $friendId,
            'friend_add_time' => $today,
            'friend_nick_name' => $friendName
        );
        $friend_id = $this->add($data);
        if($friend_id >=1){
            return true;
        }else{
            return false;
        }
    }

    //��ѯ���ߺ���
    public function getOnLineFriends($userId){
        $sql = "select * from users where user_state = 1 and user_id in(select f.friend_user_id from users u1 join friends f on u1.user_id = f.user_id where u1.user_id = $userId)";
        return $this->query($sql);
    }

    //��ѯȫ������
    public function getAllFriends($userId){
        $sql = "select * from users where user_id in(select f.friend_user_id from users u1 join friends f on u1.user_id = f.user_id where u1.user_id = $userId)";
        return $this->query($sql);
    }

    //ɾ������
    public function deleteFriend($userId,$friendId){
         $b = $this->where("user_id = '$userId' and friend_user_id = '$friendId'")->delete();
        return $b;
    }
}