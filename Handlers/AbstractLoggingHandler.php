<?php

namespace Codememory\Components\Logging\Handlers;

use Codememory\Components\Logging\Interfaces\LoggingHandlerInterface;
use Codememory\Components\Logging\Utils as LoggingUtils;
use Codememory\Support\Str;
use JetBrains\PhpStorm\Pure;

/**
 * Class AbstractLoggingHandler
 * @package Codememory\Components\Logging\Handlers
 *
 * @author  Codememory
 */
abstract class AbstractLoggingHandler implements LoggingHandlerInterface
{

    /**
     * @var LoggingUtils|null
     */
    protected ?LoggingUtils $utils = null;

    /**
     * @var array
     */
    protected array $loggerData = [];

    /**
     * @inheritDoc
     */
    public function setUtils(LoggingUtils $utils, string $loggerName): LoggingHandlerInterface
    {

        $this->utils = $utils;
        $this->loggerData = $this->utils->getLogger($loggerName);

        return $this;

    }

    /**
     * @return mixed
     */
    #[Pure] protected function getLevel(): mixed
    {

        return constant(sprintf('Monolog\Logger::%s', Str::toUppercase($this->loggerData['level'])));

    }

}