# jiguangfile
极光外链网盘
### 使用方法
```php
$qiniu = \xiflys\QiniuDrive::getInstance();
// 网盘路径本地路径
$info = $qiniu->upload('community/fly/qq/3333.png','D:\photo\pc\744922.jpg');
return $info;

# 修改
#文件 qiniudrive.php
public $authorization = "鉴权";

```