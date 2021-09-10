<?php

namespace Codememory\Components\Logging\Interfaces;

use Codememory\Components\Logging\Logger;
use JetBrains\PhpStorm\ExpectedValues;

/**
 * Interface LoggingInterface
 *
 * @package Codememory\Components\Logging\Interfaces
 *
 * @author  Codememory
 */
interface LoggingInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add new logger with information
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name              The name of the logger by which you can run it
     * @param string $handlerName       The name of the handler that this logger will process
     * @param array  $handlerParameters Parameters for the handler
     *
     * @return LoggerInterface
     */
    public function addLogger(string $name, string $handlerName, array $handlerParameters = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add a handler for loggers
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name      The name of the handler that is specified for loggers
     * @param string $namespace Namespace handler that implements the HandlerInterface interface
     * @param int    $forLevel  Handler level that will be triggered only for loggers of this level
     *
     * @return LoggingInterface
     */
    public function addHandler(string $name, string $namespace, #[ExpectedValues(Logger::LEVELS)] int $forLevel): LoggingInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Check the existence of the logger
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return bool
     */
    public function existLogger(string $name): bool;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns a logger into which you can assign or change data before sending
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return Logger
     */
    public function getLogger(string $name): Logger;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Check the existence of the handler
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return bool
     */
    public function existHandler(string $name): bool;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the added handler object
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return HandlerInterface
     */
    public function getHandler(string $name): HandlerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Execute added and configured logger
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $name
     *
     * @return LoggingInterface
     */
    public function executeLogger(string $name): LoggingInterface;

}