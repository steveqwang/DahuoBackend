# DahuoBackend

DahuoBackend 是搭火平台的后端代码库，旨在提供高效、稳定的后端服务支持。本项目使用 PHP 进行开发，主要功能包括用户管理、活动管理、数据分析等。

## 目录结构

```
.
├── app
│   ├── Console
│   ├── Exceptions
│   ├── Http
│   ├── Models
│   └── Providers
├── bootstrap
├── config
├── database
├── public
├── resources
├── routes
├── storage
└── tests
```

## 安装与运行
前置条件
- PHP >= 7.4
- Composer
- MySQL

#### 安装步骤
1.克隆代码库
```
git clone https://github.com/steveqwang/DahuoBackend.git
cd DahuoBackend
```
2.安装依赖
```
composer install
```
3.配置环境变量
复制 .env.example 文件并重命名为 .env，然后根据实际情况修改数据库配置等信息。
```
cp .env.example .env
```
4.生成应用密钥
```
php artisan key:generate
```
5.运行数据库迁移
```
php artisan migrate
```
6.启动开发服务器
```
php artisan serve
```

## 功能模块
- 用户管理
- 活动管理
- 数据分析
- 商家资源整合

## API 文档
API 文档请参考 API Documentation 进行详细了解。

## 联系方式
如有任何问题，请联系项目维护者：steveqwang@outlook.com
