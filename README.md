<h1 align="center">  v0.1 文档 </h1>

<p align="center"> 生成laravel开发模板.</p>


## 安装

```shell
$ composer require tjzen/generator -vvv
```

## 使用

## 整个模块相关内容

- [x] controller 控制器
- [x] model 模型
- [x] mingrate 迁移
- [ ] router 路由


```
> php artisan make:temp Admin/Article

```


## 独立

#### 控制器

> 不带 --file : 生成为路径下模块格式 path = "app/Http/Controllers/Admin/Article/ArticleController.php"

> 携带 --file : 生成为文件格式 path = "app/Http/Controllers/Admin/ArticleController.php"

```
> php artisan zc:controller Admin/Article  {--file}
```

#### 模型

> 不带 --file : 生成为路径下模块格式 path = "app/Models/Admin/Article/Article.php"

> 携带 --file : 生成为文件格式 path = "app/Models/Admin/Article.php"


```
> php artisan zc:model Admin/Article  {--file}
```

#### 迁移
> 如需要独立生成迁移，请使用 laravel 迁移命令


```
> php artisan make:migrate create_xxx_table
```
#### 路由

> 路由这块目前是放到controller中，与controller一起生成


## License

MIT
