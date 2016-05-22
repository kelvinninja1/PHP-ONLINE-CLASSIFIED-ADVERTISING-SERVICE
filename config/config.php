<?php

//Config::set('site_name',"Your site name");

//Config::set('languages', array('en','ru'));

// Routes. Route name => method prefix

Config::set('routes', array(
        'default'=>'',
    'admin'=>'admin_',
));

Config::set('default_route', 'default');
//Config::set('default_language', 'en');
//Config::set('default_controller', 'pages');
Config::set('default_controller', 'categories');
Config::set('default_action', 'index');

Config::set('db.host', 'localhost');
Config::set('db.user', 'u927608749_dipl');
Config::set('db.password', "qwerty87");
Config::set('db.db_name', 'u927608749_dipl');

Config::set('salt','2345ferg83horh3hfwq');
Config::set('perPage','15');
