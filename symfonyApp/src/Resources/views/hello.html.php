
<?php $view['slots']->set('title', 'Hello view'); ?>
<?php $view->extend('layout.html.php'); ?>

    <h1> Hello World! </h1>
        <div>
            Hello world from PHP template
        </div>

        <div>
            Good day <?php echo $name ?>
        </div>
    <a href="<?php echo $view['router']->path('test'); ?>">Link to test</a>


