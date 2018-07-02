##### 安装php yum源

    rpm -Uvh https://mirror.webtatic.com/yum/el7/epel-release.rpm        
    rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
    
##### 安装php相关所有包

    yum install php71w-cli.x86_64 php71w-common.x86_64 php71w-fpm.x86_64 php71w-devel.x86_64 php71w-gd.x86_64 php71w-intl.x86_64 php71w-mbstring.x86_64 php71w-mcrypt.x86_64 php71w-mysqlnd.x86_64 php71w-opcache.x86_64 php71w-pdo.x86_64 php71w-pear.noarch php71w-xml.x86_64 -y
    
##### 项目初始化

    composer install
    composer update -vvv
    php artisan migrate:install //安装数据库执行记录库
    php artisan telegram:init //登录并初始化telegram工具
    php artisan telegram:group_to_db    //讲用户加入的群组信息存储至数据库
    


##### 其他常用命令

    php artisan migrate:refresh --seed //创建数据库并初始化数据
    php artisan clear-compiled //清除
    php artisan queue:table //创建迁移
    php artisan migrate //创建数据库
    php artisan make:job jobName    //创建队列
    php artisan make:command consoleName    //创建命令行
    php artisan cache:clear /清除应用程序缓存
    php artisan cache:table //创建缓存数据库
    php artisan make:controller //生成资源控制类
    php artisan make:event //生成事件类
    php artisan make:migration //生成一个数据库迁移文件（数据库表生成文件）
    php artisan make:model //生成一个eloquent模型类（pojo）
    php artisan migrate:refresh //复位并重新运行所有的迁移
    php artisan queue:listen      //监听并运行job

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    