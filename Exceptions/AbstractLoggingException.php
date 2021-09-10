<?php

namespace Codememory\Components\Logging\Exceptions;

use ErrorException;
use JetBrains\PhpStorm\Pure;

/**
 * Class AbstractLoggingException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
abstract class AbstractLoggingException extends ErrorException
{

    /**
     * @param string|null $message
     */
    #[Pure]
    public function __construct(?string $message = null)
    {

        parent::__construct($message ?: '');

    }

}