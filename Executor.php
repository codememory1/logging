<?php

namespace Codememory\Components\Logging;

use Codememory\Components\Logging\Interfaces\LoggerDataInterface;
use Codememory\Components\Profiling\Exceptions\BuilderNotCurrentSectionException;
use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\ReportCreators\LoggingReportCreator;
use Codememory\Components\Profiling\Resource;
use Codememory\Components\Profiling\Sections\Builders\LoggingBuilder;
use Codememory\Components\Profiling\Sections\LoggingSection;
use Monolog\Logger as MonologLogger;

/**
 * Class Executor
 *
 * @package Codememory\Components\Logging
 *
 * @author  Codememory
 */
class Executor
{

    /**
     * @var LoggerDataInterface
     */
    private LoggerDataInterface $logger;

    /**
     * @param LoggerDataInterface $logger
     */
    public function __construct(LoggerDataInterface $logger)
    {

        $this->logger = $logger;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * The main method that the logger executes and saves the given
     * result to the profiler
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @throws BuilderNotCurrentSectionException
     */
    public function execute(): void
    {

        $monologLogger = $this->logger->getMonologLogger();
        $loggerData = $this->logger->getData();
        $level = $loggerData['level'];

        foreach ($this->logger->getHandlers() as $handler) {
            $monologLogger->pushHandler($handler->process());

            if ([] !== $loggerData['extra']) {
                $this->handleAddExtra($monologLogger, $loggerData);
            }

            $monologLogger->$level($loggerData['message'], $loggerData['context']);

            $this->profiling($loggerData);
        }

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Adds extra data to the logger
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param MonologLogger $monologLogger
     * @param array         $loggerData
     *
     * @return void
     */
    private function handleAddExtra(MonologLogger $monologLogger, array $loggerData): void
    {

        $monologLogger->pushProcessor(function (mixed $record) use ($loggerData) {
            $record['extra'] = $loggerData['extra'];

            return $record;
        });

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Saves the data of the running logger to the profiler
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param array $loggerData
     *
     * @return void
     * @throws BuilderNotCurrentSectionException
     */
    private function profiling(array $loggerData): void
    {

        if (Profiler::isInit()) {
            $loggingSection = new LoggingSection(new Resource());
            $loggingBuilder = new LoggingBuilder();
            $loggingReportCreator = new LoggingReportCreator(null, $loggingSection);

            $loggingBuilder
                ->setMessage($loggerData['message'])
                ->setLevel($loggerData['level'])
                ->setContext($loggerData['context']);

            $loggingReportCreator->create($loggingBuilder);
        }

    }

}