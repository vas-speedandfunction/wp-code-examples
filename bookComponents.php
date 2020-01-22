<?php

use ACFComposer\ACFComposer;
use Flynt\Api;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'bookComponents',
        'title' => 'Book Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'bookComponents',
                'label' => 'Book Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Api::loadFields('BlockImage', 'layout'),
                    Api::loadFields('BlockWysiwyg', 'layout'),
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'book',
                ],
            ],
        ],
    ]);
});
