<?php

namespace Thruster\Component\InterfaceDefinition\Entry;

use Thruster\Component\InterfaceDefinition\ActionEntryInterface;
use Thruster\Component\InterfaceDefinition\BuildableEntryInterface;
use Thruster\Component\InterfaceDefinition\EntryInterface;
use Thruster\Component\InterfaceDefinition\Exception\EntryAlreadyExistsException;
use Thruster\Component\InterfaceDefinition\Exception\EntryNotFoundException;
use Thruster\Component\InterfaceDefinition\GroupEntryInterface;

/**
 * Class GroupEntry
 *
 * @package Thruster\Component\InterfaceDefinition\Entry
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class GroupEntry implements GroupEntryInterface, BuildableEntryInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var EntryInterface[]
     */
    private $entries;

    public function __construct(string $name, array $entries = [])
    {
        $this->name = $name;
        $this->entries = (function(EntryInterface ...$entries) {
            return $entries;
        })(...$entries);
    }

    public function add(EntryInterface $entry) : GroupEntryInterface
    {
        $name = $entry->getName();

        if (false !== $this->has($name)) {
            throw new EntryAlreadyExistsException($name, $this->getName());
        }

        $this->entries[$name] = $entry;

        return $this;
    }

    public function addAction(string $name, callable $action) : ActionEntryInterface
    {
        $actionEntry = new ActionEntry($name, $action);

        $this->add($actionEntry);

        return $actionEntry;
    }

    public function addGroup(string $name) : GroupEntryInterface
    {
        $groupEntry = new GroupEntry($name);

        $this->add($groupEntry);

        return $groupEntry;
    }

    public function has(string $name) : bool
    {
        return isset($this->entries[$name]);
    }

    public function get(string $name) : EntryInterface
    {
        if (false === $this->has($name)) {
            throw new EntryNotFoundException($name, $this->getName());
        }

        return $this->entries[$name];
    }

    public function remove(string $name) : EntryInterface
    {
        if (false === $this->has($name)) {
            throw new EntryNotFoundException($name, $this->getName());
        }

        $entry = $this->entries[$name];

        unset($this->entries[$name]);

        return $entry;
    }

    public function build() : array
    {
        $result = [];
        $name = $this->getName();

        foreach ($this->entries as $subName => $entry) {
            if ($entry instanceof BuildableEntryInterface) {
                $subResult = $entry->build();

                foreach ($subResult as $subResultName => $subEntry) {
                    $result[$name . '/' . $subResultName] = $subEntry;
                }
            } elseif ($entry instanceof ActionEntryInterface) {
                $result[$name . '/' . $subName] = $entry->getAction();
            }
        }

        return $result;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getEntries() : array
    {
        return $this->entries;
    }
}
