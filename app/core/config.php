<?php
    if($_SERVER['SERVER_NAME'] == 'localhost'){
        // database config
        define('DBNAME', 'qcpl_engagement');
        define('DBHOST', 'localhost');
        define('DBUSERNAME', 'root');
        define('DBPASSWORD', '');
        define('DBDRIVER', '');

        // absolute path    
        define('ROOT', '../../public');
    }else{
        // database config
        define('DBNAME', 'u544752022_qcpl_db');
        define('DBHOST', 'localhost');
        define('DBUSERNAME', 'u544752022_root');
        define('DBPASSWORD', 'x[$GzXgW#z1V');
        define('DBDRIVER', '');

        // absolute path
        define('ROOT', '');
    }

    date_default_timezone_set('Asia/Singapore');
    date_default_timezone_get();