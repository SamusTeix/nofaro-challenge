<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function list()
    {
        $name = Input::get('name', null);
        $mail = Input::get('mail', null);

        $users = Users::orderBy('name')
                        ->when($name || $mail, function($query) use ($name, $mail) {
                            $whereRaw = '(1 = 2';
                            if($name) { $whereRaw .= ' OR name LIKE "%' . str_replace(" ", "%", $name) . '%"'; }
                            if($mail) { $whereRaw .= ' OR mail = "' . $mail . '"'; }
                            $whereRaw .= ' OR 1 = 2)';

                            $query->whereRaw($whereRaw);
                        })->get();

        return view('users-list', ['users' => $users, 'name' => $name, 'mail' => $mail]);
    }

    public function create()
    {
        return view('users-create');
    }

    public function show($id)
    {
        $user = Users::findOrFail($id);
        return view('users-show', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $alertMsg = [];

        # validacao nome
        if ($msg = self::validateName($request->name)) {
            $alertMsg[] = $msg;
        }

        # validacao email 
        if ($msg = self::validateEmail($request->mail)) {
            $alertMsg[] = $msg;
        }

        # validacao email
        if ($msg = self::validateDdd($request->ddd)) {
            $alertMsg[] = $msg;
        }

        # validacao email
        if ($msg = self::validatePhone($request->phone)) {
            $alertMsg[] = $msg;
        }

        if (count($alertMsg) > 0) {
            return redirect('usuarios/novo')->with('danger', $alertMsg);
        }

        $user = Users::create(self::sanitize($request));
        // return self::show($user->id);
        return redirect()->route('users.show', ['id' => $user->id])->with('success', ['Cadastro efetuado com sucesso']);
    }

    public function edit(Request $request)
    {
        $alertMsg = [];

        # validacao nome
        if ($msg = self::validateName($request->name)) {
            $alertMsg[] = $msg;
        }

        # validacao email 
        if ($msg = self::validateEmail($request->mail, true)) {
            $alertMsg[] = $msg;
        }

        # validacao email
        if ($msg = self::validateDdd($request->ddd)) {
            $alertMsg[] = $msg;
        }

        # validacao email
        if ($msg = self::validatePhone($request->phone)) {
            $alertMsg[] = $msg;
        }

        if (count($alertMsg) > 0) {
            return redirect('usuarios/novo')->with('danger', $alertMsg);
        }

        $user = Users::findOrFail($request->id);
        foreach (self::sanitize($request) as $key => $value) {
            $user->$key = $value;
        }
        $user->save();
        return redirect()->route('users.show', ['id' => $user->id])->with('success', ['Cadastro atualizado com sucesso']);
        // return self::show($user->id);
    }

    public function delete($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        return response('true', 200);
    }

    public function validateName($name)
    {
        if (strlen($name) < 2) {
            return "Nome deve conter pelo menos 2 caracteres";
        }
        return false;
    }

    public function validateEmail($mail, $update = false)
    {
        $user = Users::where('mail', '=', $mail)->first();
        if ($user && ! $update) {
            return "E-mail já cadastrado";
        }

        if (! strpos($mail, '@')) {
            return "E-mail invalido";
        }

        return false;
    }

    public function validateDdd($ddd)
    {
        if (! empty($ddd) && strlen($ddd) > 0 && strlen($ddd) < 2) {
            return "DDD deve conter 2 dígitos";
        }
        return false;
    }

    public function validatePhone($phone)
    {
        if (! empty($phone) && strlen($phone) > 0 && strlen($phone) < 9) {
            return "Telefone deve conter 9 dígitos";
        }
    }

    public function sanitize($request)
    {
        return ['name'  => $request->name, 
                'mail'  => $request->mail, 
                'ddd'   => $request->ddd, 
                'phone' => $request->phone];
    }
}
