# FAS 使用文档

## 工具安装

+ npm install -g fas 更新最新fas
+ npm install -g gulp 安装构建工具gulp

## 创建目录

### 关键字：

    fas init
    fas create
    fas update

+ 如果是全新项目，在newCode下使用fas init命令初始化项目目录和文件。
+ 如果是非全新项目，在项目版本同级目录下使用fas create命令来生成
+ 如果fas有版本更新，对于老项目可以在项目版本目录下使用fas update来更新配置文件

## 构建目录 

### 关键字：

    gulp
    gulp serve
    gulp clean
    gulp mock

+ 在项目版本目录下执行 npm install -d 安装依赖包文件，此过程可能需要5分钟。也可以从其他已经存在的项目下复制过来。
+ 构建文件在gulpfile.js 下，可以根据项目需求自行定制修改。或者提新需求
+ 构建文件每个task都可以单独执行，常用命令集有：gulp，gulp serve, gulp clean gulp mock
+ gulp 执行普通构建，在版本目录下会生成build目录
+ gulp serve 执行普通构建并集成本地serve来替换nginx，同时开启livereload方便开发。默认端口为3000
+ gulp clean 清空build目录，在遇到错误，或者发布之前建议执行gulp clean，全新生成build目录。
+ gulp mock 开启3001端口的http服务，用来模拟数据使用。可以在src版本目录下新建一个mock目录来模拟数据。
+ gulp [name] --type prd 执行生产构建，普通构建会生成一些辅助开发的文件，比如sourcemap，执行生产构建的时候可以去掉这些辅助文件。

## 集成功能

+ scss，css压缩合并
+ css3自动加前缀
+ css文件内图片资源根据内容自动加md5戳，并报警错误图片路径
+ jslint js语法检测
+ imagemin 图片压缩
+ 资源定位
+ 模块化html
+ 集成了ssi的本地serve，取代nginx
+ 数据mock


## 注意事项以及开发建议

+ 所有css文件使用scss后缀。原因一是为了推广scss，原因二是模块化css开发。原因三是scss本身兼容css的写法，不会因为不会写scss而带来学习成本。
+ html文件里的资源定位需要手动配置，可以按照html里的示例可以很轻松的做到配置。
+ 最后的发布构建，一定要加上 --type prd参数，否则会在生产环境带入一些不必要的请求。