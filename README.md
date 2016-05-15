# sxadmin

## 关于
我的毕业设计(2014年4月)，用`Yii 1`实现的书籍捐赠管理平台，数据库存储实现、Web端公共前台与管理后台、以及`HTTP`形式的`API`接口。

## 更新
由于相关数据库信息已经丢失，并且`Yii 2`版本的发布，为了熟悉一下`Yii 2`框架，用`Yii 2`重构此项目，并根据之前的代码恢复数据库结构。

## 安装

### 安装PHP和composer
`Yii 2`的PHP版本要求至少为`5.4`版本，但此迁移版本基于`php7`，所以建议搭建`php7`的开发环境。

安装`composer`，参考[英文官网](https://getcomposer.org/)，或者[composer中文网](http://www.phpcomposer.com/)。

### 安装composer-asset-plugin
`Yii 2`框架，默认情况下，包含`jQuery`和`Bootstrap`相关代码，这部分的静态文件依赖通过`fxp/composer-asset-plugin`这个`composer`插件来管理。

安装方式：
```
composer global require "fxp/composer-asset-plugin:~1.1.1"
```

### 安装此项目代码和依赖
获取此项目的代码，在此项目根目录(`composer.json`所在的目录)，安装依赖，执行命令:
```
composer install
```

### 安装数据库
开发环境下，使用`sqlite`数据库，数据库文件路劲为`<项目根目录>/sqlite.db`，通过`Yii 2`的数据库迁移管理来初始化数据库结构，执行代码：
```
php yii migrate
```
并有初始化管理员账户密码`admin@admin.com : admin`。

### 搭建Web服务并访问页面
访问页面需要搭建web服务器，可以使用`Yii 2`自带开发环境web服务器(基于`php 5.4 web serve`)，执行命令:
```
php yii serve
```
即可以访问`http://localhost:8080`查看页面。

如果`8080`端口已被占用，可以使用`--port=<portNum>`制定其它端口，如使用`18001`端口：
```
php yii serve --port=18001
```
即可以访问`http://localhost:18001`查看页面。