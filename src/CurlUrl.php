<?php
/**
 * CurlUrl.php
 * 文件描述
 * created on 23:31 2021/2/7 23:31
 * create by xiflys
 */

namespace xiflys\jiguangfile;


class CurlUrl
{
    public static $obj = null;
    private $ci;
    private $res;
    private $error;
    private function __construct()
    {

    }

    public function set_curl(){
        $this->ci = curl_init();
        return $this;
    }

    /**
     * 是否直接返回
     * @param int $int
     */
    public function returntransfer(int $int){
        curl_setopt($this->ci, CURLOPT_RETURNTRANSFER, $int);
        return $this;
    }

    public function url(string $url){
        curl_setopt($this->ci,CURLOPT_URL,$url);
        return $this;
    }

    /**
     * 是否验证ssl
     * @param $i CURLOPT_SSL_VERIFYPEER
     * @param $d CURLOPT_SSL_VERIFYHOST
     */
    public function ssl($i=0,$d=0){
        curl_setopt($this->ci,CURLOPT_SSL_VERIFYPEER,$i);
        curl_setopt($this->ci,CURLOPT_SSL_VERIFYHOST,$d);
        return $this;
    }

    /**
     * 是否跟随重定向页面
     * @param boolean $bool
     * @return $this
     */
    public function redirect($bool=true){
        curl_setopt($this->ci,CURLOPT_FOLLOWLOCATION,$bool);
        return $this;
    }

    public function header($i=0,$header){
        curl_setopt($this->ci,CURLOPT_HEADER,$i);
        curl_setopt($this->ci,CURLOPT_HTTPHEADER,$header);
        return $this;
    }

    public function method($m='POST'){
        curl_setopt($this->ci,CURLOPT_CUSTOMREQUEST,$m);
        return $this;
    }

    public function data(array $data=[]){
        curl_setopt($this->ci,CURLOPT_POSTFIELDS,$data);
        return $this;
    }

    public function exec(){
        $this->res = curl_exec($this->ci);
        return $this;
    }

    public function getdata(){
        if($this->res === false){
            $this->error = curl_error($this->ci);
            return $this->error;
        }
        return $this->res;
    }


    public static function getInstance(){
        if(!self::$obj instanceof self)
        {
            self::$obj = new self();
        }
        return self::$obj;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        if(!is_null($this->ci)){
            curl_close($this->ci);
        }

    }


}