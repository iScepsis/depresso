Установка:
1) php init

2) yii migrate

3) Устанавливаем миграции для панели управления rbac
 yii migrate --migrationPath=@mdm/admin/migrations

4) Собственно устанавливаем сам RBAC
yii migrate --migrationPath=@yii/rbac/migrations