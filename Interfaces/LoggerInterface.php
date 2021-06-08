<?php

namespace Codememory\Components\Logging\Interfaces;

use Monolog\Logger as MonologLogger;

/**
 * interface LoggerInterface
 * @package Codememory\Components\Logging\Interfaces
 *
 * @author  Codememory
 */
interface LoggerInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the processed logger from the monologue
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param LoggingHandlerInterface $loggingHandler
     *
     * @return MonologLogger
     */
    public function getMonologLogger(LoggingHandlerInterface $loggingHandler): MonologLogger;

}