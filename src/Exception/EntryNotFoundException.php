<?php

namespace Thruster\Component\InterfaceDefinition\Exception;

/**
 * Class EntryNotFoundException
 *
 * @package Thruster\Component\InterfaceDefinition\Exception
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class EntryNotFoundException extends \Exception
{
    public function __construct(string $name, string $selfName)
    {
        $message = sprintf(
            'Entry with name "%s" not found in "%s"',
            $name,
            $selfName
        );

        parent::__construct($message);
    }
}
