<?php
/**
 * Created by PhpStorm.
 * User: WenPinGao
 * Date: 2015/5/16
 * Time: 14:35
 */

namespace Home\Controller;


use Home\Model\Content;
use Think\Controller;

class ContentController  extends Controller{

    public function addMessage($userId,$friendId,$message){
        $contextModel = new Content();
        $b = $contextModel->addMessage($userId,$friendId,$message);
        if($b){
          echo 'ok';
        }else{
            echo 'error';
        }
    }

    public function getMessage($userId){
        $contentModel = new Content();
        $megs = $contentModel->getFriendsMessages($userId);
        if(count($megs) > 0){
            $contentModel->gaiBianState($userId);
            $str = json_encode($megs);
            echo $str;//返回JSon数据
        }else {
            echo 'none';
        }
    }
}