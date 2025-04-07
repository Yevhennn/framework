<?php

define("ROOT", dirname(__DIR__));

const DEBUG = 1;
const WWW = ROOT . '/public';
const CONFIG = ROOT . '/config';
const HELPERS = ROOT . '/helpers';

const APP = ROOT . '/app';

const CORE = ROOT . '/core';
const VIEWS = APP . '/Views';

const ERROR_LOGS = ROOT . '/tmp/error.log';

const LAYOUT = 'default';

const PATH = 'https://frame';

const DB_SETTINGS = [
    'driver' => 'mysql',
    'host' => 'MySQL-8.2',
    'database' => 'frame',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'port' => 3306,
    'prefix' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ],

];