<?php

namespace App\Controllers;

use App\Models\User;


class UserController extends BaseController
{
    public function register()
    {
        /*try{
            db()->beginTransaction();
            db()->query('insert into phones (user_id, phone) values(?, ?)', [3, 4545]);
            db()->query('insert into users (name, email, password) values(?, ?, ?)', ['Kit', 'us@mail.com', 4545]);
            db()->commit();
        }catch (\PDOException $e){
            db()->rollBack();
            dump($e);
        }*/


        return view('user/register', ['title' => 'Register page']);
    }

    public function store()
    {
        $model = new User();
        $model->loadData();
        if (!$model->validate()){
            session()->setFlash('error', 'Validation errors');
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attributes);
        }else{
            $model->attributes['password'] = password_hash($model->attributes['password'], PASSWORD_DEFAULT);
            if($id = $model->save()){
                session()->setFlash('success', 'Thanks for registration. Your ID :' . $id);
            }else {
                session()->setFlash('error', 'Error registration');
            }

        }
        response()->redirect('/register');
    }

    public function login()
    {
        return view('user/login', ['title' => 'Login page']);
    }
}