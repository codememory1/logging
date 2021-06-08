<?php

namespace Codememory\Components\Logging;

use Codememory\Components\Configuration\Config;
use Codememory\Components\Configuration\Exceptions\ConfigNotFoundException;
use Codememory\Components\Configuration\Interfaces\ConfigInterface;
use Codememory\Components\Environment\Exceptions\EnvironmentVariableNotFoundException;
use Codememory\Components\Environment\Exceptions\IncorrectPathToEnviException;
use Codememory\Components\Environment\Exceptions\ParsingErrorException;
use Codememory\Components\Environment\Exceptions\VariableParsingErrorException;
use Codememory\Components\GlobalConfig\GlobalConfig;
use Codememory\FileSystem\File;
use Codememory\Support\Arr;
use Codememory\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Utils
 * @package Codememory\Components\Logging
 *
 * @author  Codememory
 */
class Utils
{

    private const DEFAULT_TYPE = 'file';
    private const DEFAULT_LEVEL = 'debug';

    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * Utils constructor.
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function __construct()
    {

        $config = new Config(new File());

        $this->config = $config->open(GlobalConfig::get('logging.configName'), $this->defaultConfig());

    }

    /**
     * @return string[]
     */
    #[ArrayShape(['dateTimeFormat' => "string", 'recordingFormat' => "string"])]
    public function generalConfig(): array
    {

        return $this->getStructureGeneral(
            $this->config->get('_general.dateTimeFormat'),
            $this->config->get('_general.recordingFormat')
        );

    }

    /**
     * @return array
     */
    public function getLoggers(): array
    {

        $loggers = [];

        foreach ($this->config->get('_loggers') as $name => $loggerData) {
            $loggers[$name] = $this->getLogger($name);
        }

        return $loggers;

    }

    /**
     * @param string $loggerName
     *
     * @return array
     */
    public function getLogger(string $loggerName): array
    {

        $loggerOfConfig = $this->config->get(sprintf('_loggers.%s', $loggerName)) ?: false;
        $loggerData = [];

        if (false !== $loggerOfConfig) {
            $loggerData = $this->formationLoggerData(
                $loggerOfConfig['type'] ?? self::DEFAULT_TYPE,
                $loggerOfConfig['level'] ?? self::DEFAULT_LEVEL,
                $loggerOfConfig['dateTimeFormat'] ?? $this->generalConfig()['dateTimeFormat'],
                $this->formattingRecordingFormat($loggerOfConfig['recordingFormat'] ?? $this->generalConfig()['recordingFormat'])
            );

            Arr::merge($loggerData, array_diff_key($loggerOfConfig, $loggerData));
        }

        return $loggerData;

    }

    /**
     * @param string $type
     * @param string $level
     * @param string $dateFormat
     * @param string $recordingFormat
     *
     * @return array
     */
    #[ArrayShape(['type' => "string", 'level' => "string", 'dateTimeFormat' => "string", 'recordingFormat' => "string"])]
    private function formationLoggerData(string $type, string $level, string $dateFormat, string $recordingFormat): array
    {

        return [
            'type'            => $type,
            'level'           => $level,
            'dateTimeFormat'  => $dateFormat,
            'recordingFormat' => $recordingFormat
        ];

    }

    /**
     * @param string $dateFormat
     * @param string $recordingFormat
     *
     * @return string[]
     */
    #[ArrayShape(['dateTimeFormat' => "string", 'recordingFormat' => "string"])]
    private function getStructureGeneral(string $dateFormat, string $recordingFormat): array
    {

        return [
            'dateTimeFormat'  => $dateFormat,
            'recordingFormat' => $recordingFormat
        ];

    }

    /**
     * @param string $recordingFormat
     *
     * @return string
     */
    private function formattingRecordingFormat(string $recordingFormat): string
    {

        Str::replace($recordingFormat, '*', '%');

        return $recordingFormat;

    }

    /**
     * @return string[]
     */
    #[ArrayShape(['_general' => "string[]", '_loggers' => "array"])]
    private function defaultConfig(): array
    {

        return [
            '_general' => $this->getStructureGeneral(
                'Y-m-d H:i:s',
                '[*datetime*] *message*.*level_name* *context* *extra*\n'
            ),
            '_loggers' => []
        ];

    }

}