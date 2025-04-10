<?php

function app(): \PHPFramework\Application
{
    return \PHPFramework\Application::$app;
}

function request(): \PHPFramework\Request
{
    return app()->request;
}

function response(): \PHPFramework\Response
{
    return app()->response;
}

function session(): \PHPFramework\Session
{
    return app()->session;
}

function view($view = '', $data = [], $layout = ''): string|\PHPFramework\View
{
    if($view){
        return app()->view->render($view, $data, $layout);
    }

    return app()->view;
}

function abort($error = '', $code = 404){
    response()->setResponseCode($code);
    echo view("errors/{$code}", ['errors' => $error], false);
    die;
}

function base_url($path = ''): string
{
    return PATH . $path;
}

function get_alerts(): void
{
    if (!empty($_SESSION['flash'])){
        foreach($_SESSION['flash'] as $k => $v){
            echo view()->renderPartial("incs/alert_{$k}", ["flash_{$k}" => session()->getFlash($k)]);
        }
    }
}

function get_errors(string $fieldname): string
{
    $output = '';
    $errors = session()->get('form_errors');
    if(isset($errors[$fieldname])){
        $output .= '<div class="invalid-feedback d-block"><ul class="list-unstyled">';
        foreach($errors[$fieldname] as $error){
            $output .= "<li>$error</li>";
        }
        $output .= '</ul></div>';
    }
    return $output;
}

function get_validation_class(string $fieldname): string
{
    $errors = session()->get('form_errors');
    if(empty($errors)){
        return '';
    }

    return isset($errors[$fieldname]) ? 'is-invalid' : 'is-valid';
}

function old( string $fieldname): string
{
    return isset(session()->get('form_data')[$fieldname]) ? h(session()->get('form_data')[$fieldname]) : '';
}

function h( string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function get_csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="'. session()->get('csrf_token') . '">';
}

function get_csrf_meta(): string
{
    return '<meta name="csrf_token" content="'. session()->get('csrf_token') . '">';
}

function db(): \PHPFramework\Database
{
    return app()->db;
}

