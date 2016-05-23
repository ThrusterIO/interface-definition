<?php

namespace Thruster\Component\InterfaceDefinition;

/**
 * Interface ActionEntryInterface
 *
 * @package Thruster\Component\InterfaceDefinition
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
interface ActionEntryInterface extends EntryInterface
{
    public function getAction() : callable;
}
