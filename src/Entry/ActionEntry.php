<?php

namespace Thruster\Component\InterfaceDefinition\Entry;

use Thruster\Component\InterfaceDefinition\ActionEntryInterface;

/**
 * Class ActionEntry
 *
 * @package Thruster\Component\InterfaceDefinition\Entry
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ActionEntry implements ActionEntryInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var callable
     */
    private $action;


    public function __construct(string $name, callable $action)
    {
        $this->name = $name;
        $this->action = $action;
    }

    /**
     * @return callable
     */
    public function getAction() : callable
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

}
