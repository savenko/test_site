Yii 2 Advanced Project Template (Тестовый проект)
===============================

Тестовый проект. 

## Установка

```bash
git clone git remote add origin https://github.com/savenko/test_site.git .
php composer.phar self-update
php composer.phar update
php init

vagrant up
vagrant ssh
```
Создайте Базу Данных, укажите настройки для нее в /common/config/main-local.php и выполните миграции

```bash
cd /var/www/public
php yii migrate/up
```


## Первый запуск сайта

Перейдите в раздел http://test_site.local/admin/ , 
система попросит Вас установить логин и пароль 
администратора. После чего Вы сможете авторизироваться 
в административной части сайта