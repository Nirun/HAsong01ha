<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 27/10/2555
 * Time: 23:18 น.
 * To change this template use File | Settings | File Templates.
 */
class Authen
{
    var $CI;
    var $userContext = array();

    function __construct()
    {
        $this->CI = & get_instance();
    }

    /*
    * var $type 0 = admin,1=user
    * var $user = string
    * var $password = string
    */
    function login($user, $password, $type = 0)
    {
        $data = array();
        $isLogin = false;

        $this->CI->load->model('authen_m', 'authen_m');
        $this->CI->authen_m->context['user'] = $user;
        $this->CI->authen_m->context['password'] = $password;
        if ($type == 0) {
            $data = $this->CI->authen_m->loginAdmin();
            if (count($data) == 1) {
                $data = $data[0];
                $this->CI->load->model('register/admin_m', 'admin_m');
                $data2 = $this->CI->admin_m->getAuthenByUserId($data['adminID']);
                $role = array();
                foreach ($data2 as $val) {
                    $role[] = $val['permissionID'];
                }
                //var_dump($role); exit;
                $arrLogin = array(
                    'ID' => $data['adminID'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'role' => implode(',', $role),
                    'isLogin' => true
                );
                $this->setLoginSession($arrLogin);
                $isLogin = true;
            }
        } else if ($type == 1) {
            $data = $this->CI->authen_m->loginUser();
            if (count($data) == 1) {
                $data = $data[0];

                //var_dump($role); exit;
                $arrLogin = array(
                    'traineeID' => $data['traineeID'],
                    'prefix' => $data['prefix'],
                    'prefix_other' => $data['prefix_other'],
                    'name' => $data['name'],
                    'lastname' => $data['lastname'],
                    'isLogin' => true
                );
                $this->setLoginSession($arrLogin);
                $isLogin = true;
            }
        }
        return $isLogin;
    }

    function setLoginSession($data = array())
    {
        $this->CI->session->set_userdata($data);
    }

    function logout()
    {
        $this->CI->session->sess_destroy();
    }

    /*
    * $pageID = permissionID
    * $role = authorizeID
    * $redirect = page url
    */
    public static function memberAllow($allow = false, $redirect = '')
    {
        if ($allow!=true) {
            $url = ($redirect == '') ? setting::$BASE_URL . '/member/apply' : $redirect;
            redirect($url);
        }
    }

    public static function AllowPage($pageID = 0, $role = '', $redirect = '')
    {
        $dataRole = explode(',', $role);
        $url = ($redirect == '') ? setting::$BASE_URL . '/register/main/index/?err=error_permission' : $redirect;
        if (FALSE == in_array($pageID, $dataRole)) {
            redirect($url);
        }
    }
}
