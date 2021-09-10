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
     * @param string $name
     * @param string $handlerName
     * @param array  $handlerParameters
     *
     * @return LoggerInterface
     */
    public function addLogger(string $name, string $handlerName, array $handlerParameters = []): LoggerInterface;

    /**
     * @param string $name
     * @param string $namespace
     * @param int    $forLevel
     *
     * @return LoggingInterface
     */
    public function addHandler(string $name, string $namespace, #[ExpectedValues(Logger::LEVELS)] int $forLevel): LoggingInterface;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function existLogger(string $name): bool;

    /**
     * @param string $name
     *
     * @return Logger
     */
    public function getLogger(string $name): Logger;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function existHandler(string $name): bool;

    /**
     * @param string $name
     *
     * @return HandlerInterface
     */
    public function getHandler(string $name): HandlerInterface;

    /**
     * @param string $name
     *
     * @return LoggingInterface
     */
    public function executeLogger(string $name): LoggingInterface;

}