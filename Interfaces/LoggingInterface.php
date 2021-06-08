<?php

namespace Codememory\Components\Logging\Interfaces;

use Monolog\Logger as MonologLogger;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

/**
 * Interface LoggingInterface
 * @package Codememory\Components\Logging\Interfaces
 *
 * @author  Codememory
 */
interface LoggingInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add a new type of logger storage handler
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     * @param string $loggingHandlerNamespace
     *
     * @return LoggingInterface
     */
    public function addType(string $name, string $loggingHandlerNamespace): LoggingInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Create a new logger based on the name of the existing
     * logging in the configuration
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return PsrLoggerInterface|MonologLogger
     */
    public function createLogger(string $name): PsrLoggerInterface|MonologLogger;

}