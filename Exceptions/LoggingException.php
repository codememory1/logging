<?php

namespace Codememory\Components\Logging\Exceptions;

use ErrorException;
use JetBrains\PhpStorm\Pure;

/**
 * Class LoggingException
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
abstract class LoggingException extends ErrorException
{

    /**
     * LoggingException constructor.
     *
     * @param string $message
     * @param int    $code
     */
    #[Pure]
    public function __construct(string $message = "", int $code = 0)
    {

        parent::__construct($message, $code);

    }

}