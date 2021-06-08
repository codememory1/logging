<?php

namespace Codememory\Components\Logging;

use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\DateTime\Timezone;
use Codememory\Components\Logging\Interfaces\LoggerInterface;
use Codememory\Components\Logging\Interfaces\LoggingHandlerInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger as MonologLogger;

/**
 * Class Logger
 * @package Codememory\Components\Logging
 *
 * @author  Codememory
 */
class Logger implements LoggerInterface
{

    /**
     * @var array
     */
    private array $loggerData;

    /**
     * @var string
     */
    private string $loggerName;

    /**
     * Logger constructor.
     *
     * @param string $loggerName
     * @param array  $loggerData
     */
    public function __construct(string $loggerName, array $loggerData)
    {

        $this->loggerName = $loggerName;
        $this->loggerData = $loggerData;

    }

    /**
     * @inheritDoc
     * @throws InvalidTimezoneException
     */
    public function getMonologLogger(LoggingHandlerInterface $loggingHandler): MonologLogger
    {

        $monologLogger = new MonologLogger($this->loggerName);
        $formatter = new LineFormatter($this->loggerData['recordingFormat'], $this->loggerData['dateTimeFormat']);

        $loggingHandler = $loggingHandler->getHandler();

        $loggingHandler->setFormatter($formatter);

        $monologLogger->setTimezone((new Timezone())->getTimezone());
        $monologLogger->pushHandler($loggingHandler);

        return $monologLogger;

    }

}