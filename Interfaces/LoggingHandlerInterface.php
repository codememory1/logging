<?php

namespace Codememory\Components\Logging\Interfaces;

use Codememory\Components\Logging\Utils as LoggingUtils;
use Monolog\Handler\HandlerInterface as MonologHandlerInterface;

/**
 * Interface LoggingHandlerInterface
 * @package Codememory\Components\Logging\Interfaces
 *
 * @author  Codememory
 */
interface LoggingHandlerInterface
{

    /**
     * @param LoggingUtils $utils
     * @param string       $loggerName
     *
     * @return LoggingHandlerInterface
     */
    public function setUtils(LoggingUtils $utils, string $loggerName): LoggingHandlerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the logging handler object
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return MonologHandlerInterface
     */
    public function getHandler(): MonologHandlerInterface;

}