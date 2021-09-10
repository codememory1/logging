<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class LoggerNotExistException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
class LoggerNotExistException extends AbstractLoggerException
{

    /**
     * @param string $loggerName
     */
    #[Pure]
    public function __construct(string $loggerName)
    {

        parent::__construct($loggerName, sprintf('Logger named %s does not exist.', $loggerName));

    }

}