<?php
/**
 * Created by PhpStorm.
 * User: WenPinGao
 * Date: 2015/5/6
 * Time: 19:16
 */
namespace Home\Controller;

use Home\Model\Users;


class UsersController extends \Think\Controller{

    //�ж��û���¼��Ϣ
    public function checkLogin($name, $pwd){
                $userModel = new Users();
        $user = $userModel->checkLogin($name, $pwd);
        if (count($user) <= 0) {
            echo 'error';
        } else if (count($user) == 1) {
            echo 'ok';
            $id = $user[0]['user_id'];
            $userModel->userLogin($id);
        } else {
            echo 'error';
        }
        exit();
    }
    //�û�ע��
    public function zhuCe($name, $pwd, $gender, $brithday, $address, $tel){

        $array = array(
            'user_name' => $name,
            'user_pwd' => md5($pwd),
            'user_gender' => $gender,
            'user_brithday' => $brithday,
            'user_address' => $address,
            'user_tel' => $tel,
            'user_state' => 0
        );
       $userModel = new Users();
        $userId = $userModel->zhuCe($array);
        if (!empty($userId) && $userId > 0) {
            echo 'ok';
        } else {
            echo 'error';
        }
        //print_r($array);
        exit();
    }

    //�û��޸���Ϣ
    public function editUserInfo($id, $name, $pwd, $gender, $brithday, $address, $tel){

        $array = array(
            'user_name' => $name,
            'user_pwd' => $pwd,
            'user_gender' => $gender,
            'user_brithday' => $brithday,
            'user_address' => $address,
            'user_tel' => $tel,
        );
        $userModel = new Users();
        $b = $userModel->editUserInfo($array, $id);
        if ($b) {
            echo 'ok';
        } else {
            echo 'error';
        }
        exit();
    }

    //��֤�û�����Ψһ��
    public function checkUserName($name){
        $userModel = new Users();
        $b = $userModel->checkUserName($name);
        if($b){
            echo 'ok';
        }else{
            echo 'error';
        };
        exit();
    }

    //��ȡ��¼�û���Ϣ
    public function getUserInfo($name){
        $userModel = new Users();
        $users = $userModel->getUserInfo($name);
        $str = json_encode($users);
        echo $str;
    }

    //��ȡ�����������û���Ϣ
    public function getUsersInfo($name){
        $userModel = new Users();
        $users = $userModel->getUsersInfo($name);
        $str = json_encode($users);
        echo $str;
    }
    //�û��ǳ�
    public function logout($id){
        $userModel = new Users();
        $userModel->userLogout($id);
    }
}
