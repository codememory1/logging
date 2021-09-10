<?php

namespace Codememory\Components\Logging;

use Codememory\Components\Logging\Exceptions\HandlerExistException;
use Codememory\Components\Logging\Exceptions\HandlerNotExistException;
use Codememory\Components\Logging\Exceptions\HandlerNotImplementInterfaceException;
use Codememory\Components\Logging\Exceptions\LoggerExistException;
use Codememory\Components\Logging\Exceptions\LoggerNotExistException;
use Codememory\Components\Logging\Exceptions\LogLevelNotExistException;
use Codememory\Components\Logging\Interfaces\HandlerInterface;
use Codememory\Components\Logging\Interfaces\LoggerInterface;
use Codememory\Components\Logging\Interfaces\LoggingInterface;
use Codememory\Components\Profiling\Exceptions\BuilderNotCurrentSectionException;
use JetBrains\PhpStorm\ExpectedValues;
use LogicException;
use ReflectionClass;
use ReflectionException;

/**
 * Class Logging
 *
 * @package Codememory\Components\Logging
 *
 * @author  Codememory
 */
class Logging implements LoggingInterface
{

    /**
     * @var array
     */
    private array $loggers = [];

    /**
     * @var array
     */
    private array $handlers = [];

    /**
     * @throws HandlerExistException
     * @throws HandlerNotExistException
     * @throws HandlerNotImplementInterfaceException
     * @throws LogLevelNotExistException
     * @throws LoggerExistException
     * @throws ReflectionException
     */
    public function __construct()
    {

        $utils = new Utils();

        $this->registerHandlersFromConfig($utils);
        $this->registerLoggersFromConfig($utils);

    }

    /**
     * @inheritDoc
     * @throws HandlerNotExistException
     * @throws LoggerExistException
     */
    public function addLogger(string $name, string|array $handlerName, array $handlerParameters = []): LoggerInterface
    {

        if ($this->existLogger($name)) {
            throw new LoggerExistException($name);
        }

        $handlers = array_map(function (string $handlerName) use ($handlerParameters) {
            return $this->getHandler($handlerName)->setParameters($handlerParameters);
        }, is_string($handlerName) ? [$handlerName] : $handlerName);

        $logger = new Logger($name, $handlers);

        $this->loggers[$name] = $logger;

        return $logger;

    }

    /**
     * @inheritDoc
     * @throws HandlerExistException
     * @throws HandlerNotImplementInterfaceException
     * @throws LogLevelNotExistException
     * @throws ReflectionException
     */
    public function addHandler(string $name, string $namespace, #[ExpectedValues(Logger::LEVELS)] int $forLevel): LoggingInterface
    {

        if ($this->existHandler($name)) {
            throw new HandlerExistException($name, $namespace);
        }

        if (!class_exists($namespace)) {
            throw new LogicException(sprintf('The %s handler being added was not found by namespace %s', $name, $namespace));
        }

        if (!in_array($forLevel, Logger::LEVELS)) {
            throw new LogLevelNotExistException($name, $forLevel);
        }

        $reflector = new ReflectionClass($namespace);

        if (!$reflector->implementsInterface(HandlerInterface::class)) {
            throw new HandlerNotImplementInterfaceException($name, $namespace);
        }

        $this->handlers[$name] = $reflector->newInstance($forLevel);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function existLogger(string $name): bool
    {

        return array_key_exists($name, $this->loggers);

    }

    /**
     * @inheritDoc
     * @throws LoggerNotExistException
     */
    public function getLogger(string $name): Logger
    {

        return $this->loggers[$name] ?? throw new LoggerNotExistException($name);

    }

    /**
     * @inheritDoc
     */
    public function existHandler(string $name): bool
    {

        return array_key_exists($name, $this->handlers);

    }

    /**
     * @inheritDoc
     * @throws HandlerNotExistException
     */
    public function getHandler(string $name): HandlerInterface
    {

        if (!$this->existHandler($name)) {
            throw new HandlerNotExistException($name);
        }

        return $this->handlers[$name];

    }

    /**
     * @inheritDoc
     * @throws LoggerNotExistException
     * @throws BuilderNotCurrentSectionException
     */
    public function executeLogger(string $name): LoggingInterface
    {

        $executor = new Executor($this->getLogger($name));

        $executor->execute();

        return $this;

    }

    /**
     * @param Utils $utils
     *
     * @return void
     * @throws HandlerExistException
     * @throws HandlerNotImplementInterfaceException
     * @throws LogLevelNotExistException
     * @throws ReflectionException
     */
    private function registerHandlersFromConfig(Utils $utils): void
    {

        foreach ($utils->getHandlers() as $handlerName => $handlerData) {
            $this->addHandler($handlerName, $handlerData['handler'], $handlerData['forLevel']);
        }

    }

    /**
     * @param Utils $utils
     *
     * @return void
     * @throws HandlerNotExistException
     * @throws LoggerExistException
     */
    private function registerLoggersFromConfig(Utils $utils): void
    {

        foreach ($utils->getLoggers() as $loggerName => $loggerData) {
            $handlerName = $loggerData['handlerName'];
            $handlerParameters = $loggerData['handlerParameters'];

            if (!$loggerData['forRun']) {
                $this->addLogger($loggerName, $handlerName, $handlerParameters);
            } else {
                $level = $loggerData['level'];
                $message = $loggerData['message'];
                $context = $loggerData['context'];
                $extra = $loggerData['extra'];

                $this->addLogger($loggerName, $handlerName, $handlerParameters)
                    ->$level($message, $context)->addExtra($extra);
            }
        }

    }


}