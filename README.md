# mipush-for-laravel5
小米推送laravel包开发，用于app推送消息、透传等功能

## 安装
加载包

`composer require haiaouang/gaohuitong-for-laravel5`

在配置文件中添加 **config/app.php**

```php
    'providers' => [
        /**
         * 添加供应商
         */
        Hht\MiPush\MiPushServiceProvider::class,
    ],
    'aliases' => [
         /**
          * 添加别名
          */
        'MiPush' => Hht\MiPush\Facades\MiPush::class,
    ],
```

生成配置文件

`php artisan vendor:publish`

设置小米推送的参数 **config/mipush.php**

## 使用
- - -
### 设置推送客户端
\MiPush::
