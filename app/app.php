<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/FAR.php';

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function () use ($app)
    {
        return $app['twig']->render('find_and_replace.html.twig');
    });

    $app->get('far', function() use ($app)
    {
        $to_far = new Replace($_GET['phrase']);
        $replaced = $to_far->find_and_replace($_GET['word'], $_GET['replace']);
        return $app['twig']->render('found_and_replaced.html.twig', array('replaced' => $replaced));
    });

    return $app;
 ?>
