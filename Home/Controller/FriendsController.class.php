<?php
namespace Home\Controller;

use Home\Model\Friends;
use Think\Controller;

class FriendsController extends Controller {

    //��Ӻ���
     public function addFriend($userId,$friendId,$friendName){

        if($userId == $friendId){
            echo 'one';
            exit();
        }
        $friendsModel = new Friends();
        if($friendsModel->isFriend($userId,$friendId)){
            echo 'yes';//�Ѿ��Ǻ���
        }else{
            if($friendsModel->addFriend($userId,$friendId,$friendName)){
                echo 'ok';//��ӳɹ�
            }else{
                echo 'error';//���ʧ��
            }
        }
    }

    //��ѯ���ߺ���
    public function getOnlineFriends($userId){
        $friendsModel = new Friends();
        $friendsArray = $friendsModel->getOnLineFriends($userId);
        $str = json_encode($friendsArray);
        echo $str;
    }

    //��ѯȫ������
    public function getAllFriends($userId){
        $friendsModel = new Friends();
        $friendsArray = $friendsModel->getAllFriends($userId);
        $str = json_encode($friendsArray);
        echo $str;
    }

    //ɾ������
    public function deleteFriend($userId,$friendId){
        $friendModel = new Friends();
        if($friendModel->deleteFriend($userId,$friendId)){
            echo 'ok';
        }else{
            echo 'error';
        }
    }
}