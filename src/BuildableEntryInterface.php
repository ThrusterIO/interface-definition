<?php

namespace Thruster\Component\InterfaceDefinition;

/**
 * Interface BuildableEntryInterface
 *
 * @package Thruster\Component\InterfaceDefinition
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
interface BuildableEntryInterface extends EntryInterface
{
    public function build() : array;
}
