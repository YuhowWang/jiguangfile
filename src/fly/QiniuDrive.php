<?php
/**
 * QiniuDrive.php
 * 极光外链加速——七牛云
 * created on 23:30 2021/2/7 23:30
 * create by xiflys
 */

namespace fly;
require 'CurlUrl.php';

class QiniuDrive
{
    public static $obj = null;
    public $authorization = "";
    public $token;
    /**
     * @param string $token 七牛token
     * @param string $cloudname 上传文件名
     * @param string $filename 本地文件
     */
    public function upload($cloudname,$filename){
        $curl = CurlUrl::getInstance();
        $res = $curl->set_curl()
            ->url('https://upload.qiniup.com/')
            ->header(0,[])
            ->redirect(true)
            ->method('POST')
            ->data([
                'token'=>$this->token,
                'key'=>$cloudname,
                'file'=>new \CURLFile($filename)
            ])
            ->ssl(0,0)
            ->returntransfer(1)
            ->exec()
            ->getdata();
        try {
            $arr = json_decode($res,true);
            $an['url'] = 'https://sdkfiledl.jiguang.cn/'.$arr['key'];
            $an['hash'] = $arr['hash'];
            return $an;
        }catch (\Exception $e){
            return $e;
        }

    }

    public static function getInstance(){
        if(!self::$obj instanceof self)
        {
            self::$obj = new self();
            self::$obj->getToken();
        }
        return self::$obj;
    }

    public function getToken(){
        $curl = CurlUrl::getInstance();
        $res = $curl->set_curl()
            ->url('https://svr-community.jpush.cn/community/v1/user/upload/token')
            ->header(0,[
                $this->authorization,
            ])
            ->redirect(true)
            ->method('GET')
            ->ssl(0,0)
            ->returntransfer(1)
            ->exec()
            ->getdata();

        $this->token = json_decode($res,true)['content']['token'];
    }

}