<?php
namespace Home\Controller;

use Home\Model\Friends;
use Think\Controller;

class FriendsController extends Controller {

    //添加好友
     public function addFriend($userId,$friendId,$friendName){

        if($userId == $friendId){
            echo 'one';
            exit();
        }
        $friendsModel = new Friends();
        if($friendsModel->isFriend($userId,$friendId)){
            echo 'yes';//已经是好友
        }else{
            if($friendsModel->addFriend($userId,$friendId,$friendName)){
                echo 'ok';//添加成功
            }else{
                echo 'error';//添加失败
            }
        }
    }

    //查询在线好友
    public function getOnlineFriends($userId){
        $friendsModel = new Friends();
        $friendsArray = $friendsModel->getOnLineFriends($userId);
        $str = json_encode($friendsArray);
        echo $str;
    }

    //查询全部好友
    public function getAllFriends($userId){
        $friendsModel = new Friends();
        $friendsArray = $friendsModel->getAllFriends($userId);
        $str = json_encode($friendsArray);
        echo $str;
    }

    //删除好友
    public function deleteFriend($userId,$friendId){
        $friendModel = new Friends();
        if($friendModel->deleteFriend($userId,$friendId)){
            echo 'ok';
        }else{
            echo 'error';
        }
    }
}