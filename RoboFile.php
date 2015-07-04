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

        $this->taskMigration(__DIR__.'/yii');
    }

    public function taskMigration($yiiCommandPath){
        $this->say('Try migrate ...');
        return $this->taskExec($yiiCommandPath . ' migrate --interactive=0')->run();
    }
}
