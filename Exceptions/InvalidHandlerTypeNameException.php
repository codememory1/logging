<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class InvalidHandlerTypeNameException
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
class InvalidHandlerTypeNameException extends LoggingException
{

    /**
     * InvalidHandlerTypeNameException constructor.
     *
     * @param string $typeName
     */
    #[Pure]
    public function __construct(string $typeName)
    {

        parent::__construct(sprintf('A handler named like %s does not exist', $typeName));

    }

}