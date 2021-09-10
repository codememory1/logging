<?php

namespace Codememory\Components\Logging;

use Codememory\Components\Configuration\Configuration;
use Codememory\Components\Configuration\Interfaces\ConfigInterface;
use Codememory\Components\GlobalConfig\GlobalConfig;
use Codememory\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * Class Utils
 *
 * @package Codememory\Components\Logging
 *
 * @author  Codememory
 */
class Utils
{

    private const DEFAULT_HANDLER_LEVEL = 'ERROR';
    private const DEFAULT_LOG_LEVEL = 'error';

    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * Utils Construct
     */
    public function __construct()
    {

        $this->config = Configuration::getInstance()->open(GlobalConfig::get('logging.configName'));

    }

    /**
     * @return array
     */
    public function getHandlers(): array
    {

        $handlers = [];

        foreach ($this->config->get('handlers') as $name => $handler) {
            $handlers[$name] = $this->getStructureHandler($handler['handler'] ?? null, $handler['forLevel'] ?? null);
        }

        return $handlers;

    }

    /**
     * @return array
     */
    public function getLoggers(): array
    {

        $loggers = [];

        foreach ($this->config->get('loggers') as $loggerName => $logger) {
            $loggers[$loggerName] = $this->getStructureLogger(
                $logger['forRun'] ?? false,
                $logger['handlerName'] ?? '',
                $logger['level'] ?? self::DEFAULT_LOG_LEVEL,
                $logger['message'] ?? null,
                $logger['context'] ?? [],
                $logger['extra'] ?? [],
                $logger['handlerParameters'] ?? []
            );
        }

        return $loggers;

    }

    /**
     * @param string|null $handler
     * @param string|null $handlerLevel
     *
     * @return array
     */
    #[Pure]
    #[ArrayShape([
        'handler'  => "null|string",
        'forLevel' => "int"
    ])]
    private function getStructureHandler(?string $handler = null, ?string $handlerLevel = null): array
    {

        return [
            'handler'  => $handler,
            'forLevel' => $this->getLevelCode($handlerLevel ?: self::DEFAULT_HANDLER_LEVEL)
        ];

    }

    /**
     * @param bool        $forRun
     * @param string      $handlerName
     * @param string      $level
     * @param string|null $message
     * @param array       $context
     * @param array       $extra
     * @param array       $handlerParameters
     *
     * @return array
     */
    #[ArrayShape([
        'forRun'            => "bool",
        'handlerName'       => "string",
        'level'             => "string",
        'message'           => "null",
        'context'           => "array",
        'extra'             => "array",
        'handlerParameters' => "array"
    ])]
    private function getStructureLogger(bool $forRun = false, string $handlerName = '', string $level = 'error', ?string $message = null, array $context = [], array $extra = [], array $handlerParameters = []): array
    {

        return [
            'forRun'            => $forRun,
            'handlerName'       => $handlerName,
            'level'             => $level,
            'message'           => $message,
            'context'           => $context,
            'extra'             => $extra,
            'handlerParameters' => $handlerParameters
        ];

    }

    /**
     * @param string $level
     *
     * @return int
     */
    #[Pure]
    private function getLevelCode(string $level): int
    {

        $level = Str::toUppercase($level);

        return constant(sprintf('%s::%s', Logger::class, $level));

    }

}