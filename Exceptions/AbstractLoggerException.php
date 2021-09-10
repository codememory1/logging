<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class AbstractLoggerException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
abstract class AbstractLoggerException extends AbstractLoggingException
{

    /**
     * @var string
     */
    private string $loggerName;

    /**
     * @param string      $loggerName
     * @param string|null $message
     */
    #[Pure]
    public function __construct(string $loggerName, ?string $message = null)
    {

        $this->loggerName = $loggerName;

        parent::__construct($message);

    }

    /**
     * @return string
     */
    public function getLoggerName(): string
    {

        return $this->loggerName;

    }

}