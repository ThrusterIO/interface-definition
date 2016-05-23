<?php

namespace Thruster\Component\InterfaceDefinition\Exception;

/**
 * Class EntryAlreadyExistsException
 *
 * @package Thruster\Component\InterfaceDefinition\Exception
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class EntryAlreadyExistsException extends \Exception
{
    public function __construct(string $name, string $selfName)
    {
        $message = sprintf(
            'Entry with name "%s" already exists in "%s"',
            $name,
            $selfName
        );

        parent::__construct($message);
    }
}
