<?php

namespace Thruster\Component\InterfaceDefinition\Entry;

use ReflectionObject;
use ReflectionMethod;
use Thruster\Component\InterfaceDefinition\ActionEntryInterface;
use Thruster\Component\InterfaceDefinition\BuildableEntryInterface;

/**
 * Class ObjectEntry
 *
 * @package Thruster\Component\InterfaceDefinition\Entry
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ObjectEntry implements BuildableEntryInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var object
     */
    private $object;

    /**
     * @var array
     */
    private $blacklist;

    /**
     * @var ActionEntryInterface[]
     */
    private $entries;

    public function __construct(string $name, $object, array $blacklist = [])
    {
        $this->entries = [];
        $this->name = $name;
        $this->object = $object;
        $this->blacklist = $blacklist;

        $this->buildEntries();
    }
    
    public function build() : array
    {
        $name = $this->getName();

        $result = [];
        foreach ($this->entries as $entryName => $entry) {
            $result[$name . '/' . $entryName] = $entry->getAction();
        }

        return $result;
    }
    
    private function buildEntries()
    {
        $reflection = new ReflectionObject($this->object);
        $this->blacklist = array_flip($this->blacklist);

        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->name == '__construct' || isset($this->blacklist[$method->name])) {
                continue;
            }

            $actionEntry = new ActionEntry($method->name, $method->getClosure($this->object));

            $this->entries[$method->name] = $actionEntry;
        }
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
