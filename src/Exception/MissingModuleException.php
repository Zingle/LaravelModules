<?php

namespace ZingleCom\LaravelModules\Exception;

/**
 * Class MissingModuleException
 */
class MissingModuleException extends \Exception
{
    /**
     * MissingModuleException constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('Unrecognized module "%s".', $name));
    }
}
