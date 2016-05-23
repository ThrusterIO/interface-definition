<?php

namespace Thruster\Component\InterfaceDefinition;

/**
 * Interface GroupEntryInterface
 *
 * @package Thruster\Component\InterfaceDefinition
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
interface GroupEntryInterface extends EntryInterface
{
    public function getEntries() : array;

    public function add(EntryInterface $entry) : GroupEntryInterface;

    public function addAction(string $name, callable $action) : ActionEntryInterface;

    public function addGroup(string $name) : GroupEntryInterface;

    public function has(string $name) : bool;

    public function get(string $name) : EntryInterface;

    public function remove(string $name) : EntryInterface;
}
