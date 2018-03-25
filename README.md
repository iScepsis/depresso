Установка:
1) php init

2) php yii migrate

3) Устанавливаем миграции для панели управления rbac
php yii migrate --migrationPath=@mdm/admin/migrations

4) Собственно устанавливаем сам RBAC
php yii migrate --migrationPath=@yii/rbac/migrations