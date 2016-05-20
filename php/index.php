<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php';

// Create form object...
$form = \Ubnt\Html\Form::create('https://www.ubnt.com/', 'GET');

// ... Add some image...
$form->addChild(
    \Ubnt\Html\Div::create()->addClass('form-group')->addChild(
        \Ubnt\Html\Img::create('https://ubcdn.co/static/images/broadband/overview/featured-product-airos.jpg')->addClass('img-thumbnail')
    )
);

// ... Add link...
$form->addChild(
    \Ubnt\Html\Div::create()->addClass('form-group')->addChild(
        \Ubnt\Html\A::create('https://www.ubnt.com', [
            'target' => '_blank',
        ])->addChild('Go to Ubiquiti Networks website')
    )
);

// ... Add some text input...
$form->addChild(
    \Ubnt\Html\Div::create()->addClass('form-group')->addChild(
        \Ubnt\Html\Input::create('email', '', [
            'placeholder' => 'E-mail',
        ])->addClass('form-control')
    )
);

// ... And a couple of checkboxes...
$form->addChild(
    \Ubnt\Html\Div::create()->addClass('form-group')->addChildren([
        \Ubnt\Html\Div::create()->addClass('checkbox')->addStyle('padding-left', '20px')->addChildren([
            \Ubnt\Html\Input::create('checkbox'),
            'Choice one'
        ]),
        \Ubnt\Html\Div::create()->addClass('checkbox')->addStyle('padding-left', '20px')->addChildren([
            \Ubnt\Html\Input::create('checkbox')->setAttribute('checked', TRUE),
            'Choice two'
        ]),
    ])
);

// ... Add some select...
$form->addChild(
    \Ubnt\Html\Div::create()->addClass('form-group')->addChild(
        \Ubnt\Html\Select::create([
            \Ubnt\Html\Option::create(1, 'Mary J. Blige'),
            \Ubnt\Html\Option::create(2, 'Steven Tyler'),
            \Ubnt\Html\Option::create(3, 'Stevie Nicks'),
            \Ubnt\Html\Option::create(4, 'Joe Cocker', TRUE),
        ])->addClass('form-control')
    )
);

// ... And another multi select...
$form->addChild(
    \Ubnt\Html\Div::create()->addClass('form-group')->addChild(
        \Ubnt\Html\Select::create([
            \Ubnt\Html\Option::create(1, 'Mary J. Blige'),
            \Ubnt\Html\Option::create(2, 'Steven Tyler', TRUE),
            \Ubnt\Html\Option::create(3, 'Stevie Nicks'),
            \Ubnt\Html\Option::create(4, 'Joe Cocker', TRUE),
        ], TRUE)->addClass('form-control')
    )
);

// ... Finally wrap everything in responsive markup...
$container = \Ubnt\Html\Div::create()->addClass('container')->addStyle('padding-top', '50px')->addChild(
    \Ubnt\Html\Div::create()->addClass('row')->addChild(
        \Ubnt\Html\Div::create()->create()->addClass('col-md-4')->addClass('col-md-offset-4')->addChild($form)
    )
);

// ... And add some styles
$link = \Ubnt\Html\Link::create('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', 'stylesheet', [
    'integrity'   => 'sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7',
    'crossorigin' => 'anonymous',
]);

// Here we go!
echo $container;
echo $link;