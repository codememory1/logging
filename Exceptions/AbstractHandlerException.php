<?php

namespace Codememory\Components\Logging\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class AbstractHandlerException
 *
 * @package Codememory\Components\Logging\Exceptions
 *
 * @author  Codememory
 */
abstract class AbstractHandlerException extends AbstractLoggingException
{

    /**
     * @var string
     */
    private string $handlerName;

    /**
     * @var string|null
     */
    private ?string $namespace;

    /**
     * @param string      $handlerName
     * @param string|null $namespace
     * @param string|null $message
     */
    #[Pure]
    public function __construct(string $handlerName, ?string $namespace = null, ?string $message = null)
    {

        $this->handlerName = $handlerName;
        $this->namespace = $namespace;

        parent::__construct($message ?: '');

    }

    /**
     * @return string
     */
    public function getHandlerName(): string
    {

        return $this->handlerName;

    }

    /**
     * @return string|null
     */
    public function getNamespace(): ?string
    {

        return $this->namespace;

    }

}