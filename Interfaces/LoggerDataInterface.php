<?php

namespace Codememory\Components\Logging\Interfaces;

use Monolog\Logger as MonologLogger;

/**
 * Interface LoggerDataInterface
 *
 * @package Codememory\Components\Logging\Interfaces
 *
 * @author  Codememory
 */
interface LoggerDataInterface
{

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return MonologLogger
     */
    public function getMonologLogger(): MonologLogger;

    /**
     * @return HandlerInterface[]
     */
    public function getHandlers(): array;

}