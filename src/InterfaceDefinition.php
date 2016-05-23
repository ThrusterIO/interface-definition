<?php

namespace Thruster\Component\InterfaceDefinition;

use Thruster\Component\InterfaceDefinition\Entry\GroupEntry;

/**
 * Class InterfaceDefinition
 *
 * @package Thruster\Component\InterfaceDefinition
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class InterfaceDefinition extends GroupEntry
{
    /**
     * @var bool
     */
    private $built;

    /**
     * @var callable[]
     */
    private $definition;

    public function __construct()
    {
        parent::__construct('');

        $this->built = false;
    }

    public function resolve(string $identifier) : callable
    {
        if (false === $this->built) {
            $this->definition = $this->build();
        }

        if (false === isset($this->definition[$identifier])) {
            throw new \Exception;
        }

        return $this->definition[$identifier];
    }
}
