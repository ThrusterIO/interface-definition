<?php

require_once __DIR__ . '/vendor/autoload.php';


$definition = new \Thruster\Component\InterfaceDefinition\InterfaceDefinition();


$definition->addAction('status', function () {});
$group = $definition->addGroup('tasks');

$group->addAction('list', function () {});

$a = new class {
    public function visible() {}

    public function notVisible() {}

    private function privateFunction()
    {

    }

    public static function staticFunction()
    {

    }
};


$group->add(new \Thruster\Component\InterfaceDefinition\Entry\ObjectEntry('demo_object', $a, ['notVisible']));


var_dump($definition->build());
