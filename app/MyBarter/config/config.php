<?php
use MyBarter\lib\Config;

Config::set('routes', array(
        'default'=>'',
    'admin'=>'admin_',
));

Config::set('default_route', 'default');
Config::set('default_controller', 'categories');
Config::set('default_action', 'index');

Config::set('db.host', 'localhost');
Config::set('db.user', '');
Config::set('db.password', "");
Config::set('db.db_name', '');

Config::set('salt','2345ferg83horh3hfwq');
Config::set('perPage','15');
