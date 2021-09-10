<?php

namespace Codememory\Components\Logging\Handlers;

use Codememory\Components\Logging\Interfaces\HandlerInterface;

/**
 * Class AbstractHandler
 *
 * @package Codememory\Components\Logging\Handlers
 *
 * @author  Codememory
 */
abstract class AbstractHandler implements HandlerInterface
{

    /**
     * @var int
     */
    protected int $forLevel;

    /**
     * @var array
     */
    protected array $parameters = [];

    /**
     * @param int $forLevel
     */
    public function __construct(int $forLevel)
    {

        $this->forLevel = $forLevel;

    }

    /**
     * @inheritDoc
     */
    public function setParameters(array $parameters): HandlerInterface
    {

        $this->parameters = $parameters;

        return $this;

    }

}