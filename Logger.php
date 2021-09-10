<?php

namespace Codememory\Components\Logging;

use Codememory\Components\Logging\Interfaces\HandlerInterface;
use Codememory\Components\Logging\Interfaces\LoggerDataInterface;
use Codememory\Components\Logging\Interfaces\LoggerInterface;
use JetBrains\PhpStorm\ArrayShape;
use Monolog\Logger as MonologLogger;

/**
 * Class Logger
 *
 * @package Codememory\Components\Logging
 *
 * @author  Codememory
 */
class Logger implements LoggerInterface, LoggerDataInterface
{

    public const EMERGENCY = MonologLogger::EMERGENCY;
    public const ALERT = MonologLogger::ALERT;
    public const CRITICAL = MonologLogger::CRITICAL;
    public const ERROR = MonologLogger::ERROR;
    public const WARNING = MonologLogger::WARNING;
    public const NOTICE = MonologLogger::NOTICE;
    public const INFO = MonologLogger::INFO;
    public const DEBUG = MonologLogger::DEBUG;
    public const LEVELS = [
        self::EMERGENCY,
        self::ALERT,
        self::CRITICAL,
        self::ERROR,
        self::WARNING,
        self::NOTICE,
        self::INFO,
        self::DEBUG
    ];

    /**
     * @var MonologLogger
     */
    private MonologLogger $monologLogger;

    /**
     * @var HandlerInterface[]
     */
    private array $handlers;

    /**
     * @var array
     */
    private array $data = [
        'level'   => null,
        'message' => null,
        'context' => [],
        'extra'   => []
    ];

    /**
     * @param string             $name
     * @param HandlerInterface[] $handlers
     */
    public function __construct(string $name, array $handlers)
    {

        $this->monologLogger = new MonologLogger($name);
        $this->handlers = $handlers;

    }

    /**
     * @inheritDoc
     */
    public function emergency(string $message, array $context = []): LoggerInterface
    {

        $this->addRecord(__FUNCTION__, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function alert(string $message, array $context = []): LoggerInterface
    {

        $this->addRecord(__FUNCTION__, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function critical(string $message, array $context = []): LoggerInterface
    {

        $this->addRecord(__FUNCTION__, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function error(string $message, array $context = []): LoggerInterface
    {

        $this->addRecord(__FUNCTION__, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function warning(string $message, array $context = []): LoggerInterface
    {

        $this->addRecord(__FUNCTION__, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function notice(string $message, array $context = []): LoggerInterface
    {

        $this->addRecord(__FUNCTION__, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function info(string $message, array $context = []): LoggerInterface
    {

        $this->addRecord(__FUNCTION__, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function debug(string $message, array $context = []): LoggerInterface
    {

        $this->addRecord(__FUNCTION__, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function log(int $level, string $message, array $context = []): LoggerInterface
    {

        $this->addRecord($level, $message, $context);

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function addExtra(array $data): LoggerInterface
    {

        $this->data['extra'] = $data;

        return $this;

    }

    /**
     * @inheritDoc
     */
    #[ArrayShape([
        'level'   => 'null|string',
        'message' => 'null|string',
        'context' => 'array',
        'extra'   => 'array',
    ])]
    public function getData(): array
    {

        return $this->data;

    }

    /**
     * @inheritDoc
     */
    public function getMonologLogger(): MonologLogger
    {

        return $this->monologLogger;

    }

    /**
     * @inheritDoc
     */
    public function getHandlers(): array
    {

        return $this->handlers;

    }

    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     */
    private function addRecord(string $level, string $message, array $context = []): void
    {

        $this->data['level'] = $level;
        $this->data['message'] = $message;
        $this->data['context'] = $context;

    }


}