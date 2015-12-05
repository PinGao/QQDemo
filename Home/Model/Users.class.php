<?php
/**
 * Created by PhpStorm.
 * User: WenPinGao
 * Date: 2015/5/6
 * Time: 18:55
 */

namespace Home\Model;
use Think\Model;

class Users extends Model {
    protected $trueTableName = 'users';

    /**???没????
     * @param $name
     * @param $pwd
     * @return mixed
     */
    public function checkLogin($name,$pwd){
        $str = md5($pwd);
        $user = $this->where("user_name= '$name' and user_pwd = '$str' ")->select();
        return $user;
    }

    /**注??
     * @param $array:????息??
     * @return bool
     */
    public function zhuCe($array){
        $id = $this->add($array);
        return $id;
    }

    /**?????
     * @param $array:????息??
     * @param $userId:???Id
     * @return bool
     */
    public function editUserInfo($array,$userId){
        return $this->where('user_id = '.$userId)->save($array);
    }

    /**?证???????一?
     * @param $name:????
     * @return bool:唯一,true,??,false
     */
    public function checkUserName($name){
        $user = $this->field('user_id')->where("user_name = '$name'")->select();
        if(count($user) <= 0){
            return true;
        }else{
            return false;
        }
    }
    //获取用户信息
    public function getUserInfo($name){
        $user =  $this->where("user_name = '$name'")->select();
        return $user;
    }
    //获取用户们的信息
    public function getUsersInfo($name){
        $user =  $this->where("user_name like '$name%'")->select();
        return $user;
    }
    /**当用户登录时,将其状态改为1
     * @param $Id
     */
    public function userLogin($Id){
        $data = array(
            'user_state' => 1
        );
        $this->where('user_id = '.$Id)->save($data);
    }
    /*
        当用户登出时,将其状态改为0
    */
    public function userLogout($Id){
        $data = array(
            'user_state' => 0
        );
        $this->where('user_id = '.$Id)->save($data);
    }
}
