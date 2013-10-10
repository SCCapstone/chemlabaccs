<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= APP_NAME ?> | <?= $title ?></title>
        <link rel="shortcut icon" href="img/favicon.png">
        <?= $_styles ?>
        <?= $_scripts ?>
        <style type="text/css">
            body {
                padding-top: 50px;
            }
        </style>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../../assets/js/html5shiv.js"></script>
          <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?= anchor('', APP_NAME, array('class' => 'navbar-brand')); ?>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Link <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Link</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Link Header</li>
                                <li><a href="#">Link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php if (CI()->auth->is_authenticated()): ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Signed in as <strong><?= $user_name ?></strong> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Sign out</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php else: ?>
                        <?php echo form_open('users/signin', array('class' => 'navbar-form navbar-right')); ?>
                            <div class="form-group">
                                <?php
                                    echo form_input(array(
                                        'name' => 'user_name',
                                        'id' => 'user_name',
                                        'class' => 'form-control',
                                        'placeholder' => 'Username'
                                    ));
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                    echo form_password(array(
                                        'name' => 'password',
                                        'id' => 'password',
                                        'class' => 'form-control',
                                        'placeholder' => 'Password'
                                    ));
                                ?>
                            </div>
                            <?php
                                echo form_submit(array(
                                    'name' => 'sign-in',
                                    'id' => 'sign-in',
                                    'class' => 'btn btn-success',
                                    'value' => 'Sign in'
                                ));
                            ?>
                        <?php echo form_close(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="jumbotron">
            <div class="container">
                <h2>Do You Need to Fill Out an Accident Report?</h2>
                <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                <p><a class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2>Heading</h2>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>
                    <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
                </div>
            </div>
            <hr />
            <footer>
                <p>&copy; Company 2013</p>
            </footer>
            <?php print $content ?>
        </div>
    </body>
</html>