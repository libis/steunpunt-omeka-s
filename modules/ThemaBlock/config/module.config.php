<?php
return [
    'block_layouts' => [
        'invokables' => [
            'ThemaBlock' => ThemaBlock\Site\BlockLayout\ThemaBlock::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ],
    ]
];
