<?php

namespace Codememory\Components\Logging\Handlers;

use Codememory\Components\GlobalConfig\GlobalConfig;
use Codememory\FileSystem\File;
use Codememory\FileSystem\Interfaces\FileInterface;
use Monolog\Handler\HandlerInterface as MonologHandlerInterface;
use Monolog\Handler\StreamHandler as MonologStreamHandler;

/**
 * Class StreamHandler
 * @package Codememory\Components\Logging\Handlers
 *
 * @author  Codememory
 */
class StreamHandler extends AbstractLoggingHandler
{

    /**
     * @var FileInterface
     */
    private FileInterface $filesystem;

    /**
     * StreamHandler constructor.
     */
    public function __construct()
    {

        $this->filesystem = new File();

    }

    /**
     * @inheritDoc
     * @return MonologHandlerInterface
     */
    public function getHandler(): MonologHandlerInterface
    {

        $pathForSaveLog = $this->loggerData['path'] ?? GlobalConfig::get('logging.pathToLogger');

        return new MonologStreamHandler($this->filesystem->getRealPath($pathForSaveLog), $this->getLevel());

    }

}