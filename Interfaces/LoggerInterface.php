<?php

namespace Codememory\Components\Logging\Interfaces;

/**
 * Interface LoggerInterface
 *
 * @package Codememory\Components\Logging\Interfaces
 *
 * @author  Codememory
 */
interface LoggerInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * System is unusable.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function emergency(string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function alert(string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function critical(string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function error(string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function warning(string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Normal but significant events.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function notice(string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function info(string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Detailed debug information.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function debug(string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Logs with an arbitrary level.
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return LoggerInterface
     */
    public function log(int $level, string $message, array $context = []): LoggerInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add additional data for the log
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param array $data
     *
     * @return LoggerInterface
     */
    public function addExtra(array $data): LoggerInterface;

}