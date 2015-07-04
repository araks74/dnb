<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function update($opts = ['dev' => false])
    {
        $this->taskGitStack()->stopOnFail()->pull()->run();

        if ($opts['dev']) {
            $this->taskComposerInstall()->run();
        } else {
            $this->taskComposerInstall()->noDev()->run();
        }

        $this->migration(__DIR__ . '/yii');
    }

    public function migration($yiiCommandPath)
    {
        $this->say('Try migrate ...');

        return $this->taskExec($yiiCommandPath . ' migrate --interactive=0')->run();
    }

    public function initDb()
    {
        $this->say('Init database');
        $dbHost = $this->ask('Project db host:', false);
        $rootPwd = $this->ask('Enter root password:', true);
        $dbName = $this->ask('Project db name:', false);
        $dbUser = $this->ask('Project db user:', false);
        $dbPassword = $this->ask('Project db password:', false);

        $connection = new PDO('mysql:host=' . $dbHost, 'root', $rootPwd);
        $connection->exec("CREATE USER '{$dbUser}'@'%' IDENTIFIED BY '{$dbPassword}' ;");
        $connection->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` ;");
        $connection->exec("GRANT ALL ON `{$dbName}`.* TO '{$dbUser}'@'%' ;");
        $connection->exec('FLUSH PRIVILEGES ;');

        $dbConfText = file_get_contents('./config/db.examle.php');
        $dbConfText = str_replace(
            ['{{DBHOST}}', '{{DBNAME}}', '{{DBUSER}}', '{{DBPASS}}'],
            [$dbHost, $dbName, $dbUser, $dbPassword],
            $dbConfText
        );
        file_put_contents('./config/db.php', $dbConfText);
    }

    public function initPermission()
    {
        $this->taskExec('find /var/www/www-data -type f -exec setfacl -m g:www-data:rw -m u:www-data:rw {} \;')->run();
        $this->taskExec('find /var/www/www-data -type d -exec setfacl -m g:www-data:rwX -m u:www-data:rwX {} \;')->run();
        $this->taskExec('find /var/www/www-data -type d -exec setfacl -d -m g:www-data:rwX -m u:www-data:rwX {} \;')->run();
    }

    public function initAll()
    {
        $this->initDb();
        $this->initPermission();
    }

}
