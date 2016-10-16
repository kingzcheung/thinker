<?php

$t = [
    'command' => [
        'test'            => '\Thinker\Command\TestCommand',
        'debug'           => '\Thinker\Command\DebugCommand',
        'clear'           => '\Thinker\Command\ClearCommand',
        'make.controller' => '\Thinker\Command\ControllerCommand',
        'make.model'      => '\Thinker\Command\ModelCommand',
        'make.module'     => '\Thinker\Command\ModuleCommand',

    ]
];

var_dump(array_search('\Thinker\Command\TestCommand',$t['command']));