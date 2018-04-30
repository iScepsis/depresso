Установка:
1) php init
    1.1) add your database configuration in common/config/main-local.php
    1.2) composer install
2) php yii migrate

3) Устанавливаем миграции для панели управления rbac
php yii migrate --migrationPath=@mdm/admin/migrations

4) Собственно устанавливаем сам RBAC
php yii migrate --migrationPath=@yii/rbac/migrations