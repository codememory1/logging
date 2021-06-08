<?php

namespace Codememory\Components\Logging;

use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\Logging\Exceptions\HandlerNotImplementInterfaceException;
use Codememory\Components\Logging\Exceptions\InvalidHandlerTypeNameException;
use Codememory\Components\Logging\Handlers\RedisHandler as CodememoryRedisHandler;
use Codememory\Components\Logging\Handlers\StreamHandler as CodememoryFileHandler;
use Codememory\Components\Logging\Interfaces\LoggingHandlerInterface;
use Codememory\Components\Logging\Interfaces\LoggingInterface;
use Codememory\Components\Logging\Logger as CodememoryLogger;
use Codememory\Components\Logging\Utils as LoggingUtils;
use Monolog\Logger as MonologLogger;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use ReflectionClass;
use ReflectionException;

/**
 * Class Logging
 * @package Codememory\Components\Logging
 *
 * @author  Codememory
 */
class Logging implements LoggingInterface
{

    public const REDIS_HANDLER = 'redis';
    public const STREAM_HANDLER = 'stream';

    /**
     * @var array
     */
    private array $loggingTypes = [
        self::REDIS_HANDLER  => CodememoryRedisHandler::class,
        self::STREAM_HANDLER => CodememoryFileHandler::class
    ];

    /**
     * @var LoggingUtils
     */
    private LoggingUtils $utils;

    /**
     * Logging constructor.
     */
    public function __construct()
    {

        $this->utils = new LoggingUtils();

    }

    /**
     * @inheritDoc
     * @throws HandlerNotImplementInterfaceException
     * @throws ReflectionException
     */
    public function addType(string $name, string $loggingHandlerNamespace): LoggingInterface
    {

        $reflector = new ReflectionClass($loggingHandlerNamespace);

        if (!$reflector->implementsInterface(LoggingHandlerInterface::class)) {
            throw new HandlerNotImplementInterfaceException(LoggingHandlerInterface::class);
        }

        $this->loggingTypes[$name] = $loggingHandlerNamespace;

        return $this;

    }

    /**
     * @inheritDoc
     * @throws InvalidHandlerTypeNameException
     * @throws InvalidTimezoneException
     */
    public function createLogger(string $name): PsrLoggerInterface|MonologLogger
    {

        $loggerData = $this->utils->getLogger($name);

        $codememoryLogger = new CodememoryLogger($name, $loggerData);

        $handler = $this->getHandlerByName($loggerData['type']);
        $handler->setUtils($this->utils, $name);

        return $codememoryLogger->getMonologLogger($handler);

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns a log storage handler object by its type
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $typeName
     *
     * @return bool|LoggingHandlerInterface
     * @throws InvalidHandlerTypeNameException
     */
    private function getHandlerByName(string $typeName): bool|LoggingHandlerInterface
    {

        if (array_key_exists($typeName, $this->loggingTypes)) {
            $handlerNamespace = $this->loggingTypes[$typeName];

            return new $handlerNamespace();
        }

        throw new InvalidHandlerTypeNameException($typeName);

    }

}