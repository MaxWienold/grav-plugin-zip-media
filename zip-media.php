<?php

namespace Grav\Plugin;

use Grav\Common\Flex\Types\Pages\PageObject;
use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;

/**
 * Class ZipMediaPlugin
 * @package Grav\Plugin
 */
class ZipMediaPlugin extends Plugin
{
    protected $options;

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onAdminSave' => ['onAdminSave', 0],
            'onGetPageBlueprints' => ['onGetPageBlueprints', 0]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * @param $event
     * @return void
     */
    public function onGetPageBlueprints($event): void
    {

        $types = $event->types;
        $types->scanBlueprints('plugins://' . $this->name . '/blueprints');
    }

    /**
     * Called when a page is saved from the admin plugin.
     *
     */
    public function onAdminSave($event): bool
    {
        $page = $event['object'];
        if (!($page instanceof Page || $page instanceof PageObject)) {
            return false;
        }
        if (!isset($page->header->zip)) {
            return false;
        }

        $this->options = $page->header->zip;
        $archiveFilename = $this->options->filename ?? $page->folder;
        $path = $page->path() . "/" . $archiveFilename . ".zip";
        $this->createZipFile($path, $page);

        return true;
    }

    /**
     * @param string $path
     * @param $page
     * @return void
     */
    public function createZipFile(string $path, $page): void
    {

        $zipFlag = file_exists($path) ? \ZipArchive::OVERWRITE : \ZipArchive::CREATE;
        try {
            $archive = new \ZipArchive();
            $archive->open($path, $zipFlag);
            foreach ($this->options['media'] as $filename) {
                $archive->addFile($page->path() . "/$filename", $filename);
            }
            $archive->close();
        } catch (\Exception $e) {
            $this->grav['log']->error($e);
            $this->grav['admin']->setMessage('Something went wrong with the zip media plugin. See the logs for more info', 'error');
        }
    }

}
