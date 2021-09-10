<?php

namespace Codememory\Components\Logging\Handlers;

use Codememory\FileSystem\File;
use Monolog\Handler\HandlerInterface as MonologHandlerInterface;
use Monolog\Handler\StreamHandler as MonologStreamHandler;

/**
 * Class StreamHandler
 *
 * @package Codememory\Components\Logging\Handlers
 *
 * @author  Codememory
 */
class StreamHandler extends AbstractHandler
{

    private const DEFAULT_FILENAME = 'logs.log';

    /**
     * @inheritDoc
     */
    public function process(): MonologHandlerInterface
    {

        $filesystem = new File();
        $path = $this->parameters['path'] ?? self::DEFAULT_FILENAME;

        return new MonologStreamHandler($filesystem->getRealPath($path), $this->forLevel);

    }

}