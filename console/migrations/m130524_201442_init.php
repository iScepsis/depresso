<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //Пользователи
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        //Категории к которым будут относиться статьи
        $this->createTable('ds_categories', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique()->comment('Техническое название категории'),
            'label' => $this->string()->notNull()->unique()->comment('Название категории'),
            'description' => $this->string()->null()->comment('Краткое описание категории'),
            'parent_id' => $this->integer()->null()->comment('id родительской категории'),
            'is_active' => $this->boolean()->defaultValue(0)->comment('Активна ли категория')
        ]);

        $this->addCommentOnTable('ds_categories', 'Таблица с категориями, к которым могут принадлежать статьи');
        $this->addForeignKey('fk_fid_parent_category', 'ds_categories', 'parent_id', 'ds_categories', 'id');

        //Статьи
        $this->createTable('ds_posts', [
            'id' => $this->primaryKey(),
            'fid_category' => $this->integer()->notNull()->comment('id категории к которой принадлежит статья'),
            'title' => $this->string()->notNull()->comment('Техническое название статьи'),
            'label' => $this->string()->notNull()->comment('Название статьи'),
            'content' => $this->text()->null()->comment('Контент статьи в виде html-разметки'),
            'created_at' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'views_count' => $this->integer()->notNull()->defaultValue(0)->comment('Количество просмотров'),
            'likes_count' => $this->integer()->null()->defaultValue(0)->comment('Количество лайков'),
            'dislikes_count' => $this->integer()->null()->defaultValue(0)->comment('Количество дизлайков'),
            'fid_user' => $this->integer()->notNull()->comment('id пользователя создавшего статью'),
            'is_active' => $this->boolean()->notNull()->defaultValue(0)->comment('Активна ли статья'),
        ]);

        $this->addCommentOnTable('ds_posts', 'Таблица со статьями');
        $this->addForeignKey('fk_posts_fid_category', 'ds_posts', 'fid_category', 'ds_categories', 'id');
        $this->addForeignKey('fk_posts_fid_user', 'ds_posts', 'fid_user', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropTable('ds_posts');
        $this->dropTable('ds_categories');
        $this->dropTable('{{%user}}');

    }
}
