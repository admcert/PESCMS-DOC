<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version
 */

namespace App\Doc\POST;

class Login extends \Core\Controller\Controller{

    public function index(){

        if(\Core\Func\CoreFunc::$param['system']['verify'] == '1'){
            $this->checkVerify();
        }

        $data['user_account'] = $data['user_mail'] = $this->isP('account', '请提交账号信息');
        $login = $this->db('user')->where('(user_account = :user_account OR user_mail = :user_mail) AND user_status = 1 ')->find($data);
        if(empty($login)){
            $this->error('帐号或者密码错误，也可能您的账号被禁止登录鸟!');
        }

        $data['user_password'] = \Core\Func\CoreFunc::generatePwd($login['user_account'].$this->isP('passwd', '请提交密码'));

        if($login['user_password'] !== $data['user_password']){
            $this->error('帐号或者密码错误，也可能您的账号被禁止登录鸟!');
        }

        $_SESSION['user'] = $login;

        //若返回上一页为空，那么跳转到用户自定义的首页
        if(empty($_POST['back_url'])){
            $url = $this->url('Doc-Index-index');
        }else{
            $url = base64_decode($_POST['back_url']);
        }

        $this->success('登录成功!', $url);
    }

}