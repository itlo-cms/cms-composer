<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link https://skeeks.com/
 * @copyright (c) 2010 SkeekS
 * @date 10.11.2017
 */
namespace itlo\cms\composer;

use Composer\Installer\LibraryInstaller;
use Composer\Script\Event;
use Composer\Installer\PackageEvent;
use itlo\cms\components\Cms;
use itlo\cms\helpers\FileHelper;
use yii\helpers\ArrayHelper;

class Installer extends LibraryInstaller
{
    public static function clearDirs(Event $event)
    {
        $params = $event->getComposer()->getPackage()->getExtra();

        if (isset($params[__METHOD__]['dirs']) && is_array($params[__METHOD__]['dirs'])) {
            foreach ($params[__METHOD__]['dirs'] as $dir)
            {
                if (is_dir($dir))
                {
                    $dir = realpath($dir);
                    echo "\tclear dir: {$dir}\n";
                    try {
                        FileHelper::removeDirectory($dir);
                        FileHelper::createDirectory($dir);
                    } catch (\Exception $e) {
                        echo "\t\t error: {$e->getMessage()}\n";
                    }
                }
            }
        }
    }
}