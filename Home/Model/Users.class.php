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

    /**???û????
     * @param $name
     * @param $pwd
     * @return mixed
     */
    public function checkLogin($name,$pwd){
        $str = md5($pwd);
        $user = $this->where("user_name= '$name' and user_pwd = '$str' ")->select();
        return $user;
    }

    /**ע??
     * @param $array:????Ϣ??
     * @return bool
     */
    public function zhuCe($array){
        $id = $this->add($array);
        return $id;
    }

    /**?????
     * @param $array:????Ϣ??
     * @param $userId:???Id
     * @return bool
     */
    public function editUserInfo($array,$userId){
        return $this->where('user_id = '.$userId)->save($array);
    }

    /**?֤???????һ?
     * @param $name:????
     * @return bool:Ψһ,true,??,false
     */
    public function checkUserName($name){
        $user = $this->field('user_id')->where("user_name = '$name'")->select();
        if(count($user) <= 0){
            return true;
        }else{
            return false;
        }
    }
    //��ȡ�û���Ϣ
    public function getUserInfo($name){
        $user =  $this->where("user_name = '$name'")->select();
        return $user;
    }
    //��ȡ�û��ǵ���Ϣ
    public function getUsersInfo($name){
        $user =  $this->where("user_name like '$name%'")->select();
        return $user;
    }
    /**���û���¼ʱ,����״̬��Ϊ1
     * @param $Id
     */
    public function userLogin($Id){
        $data = array(
            'user_state' => 1
        );
        $this->where('user_id = '.$Id)->save($data);
    }
    /*
        ���û��ǳ�ʱ,����״̬��Ϊ0
    */
    public function userLogout($Id){
        $data = array(
            'user_state' => 0
        );
        $this->where('user_id = '.$Id)->save($data);
    }
}
