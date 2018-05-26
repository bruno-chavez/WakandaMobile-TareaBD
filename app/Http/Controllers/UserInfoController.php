<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Input;

class UserInfoController extends Controller
{
    public function __construct() {

        $this->middleware('auth:division');
    }

    public function index(User $user) {

        return view('division.user_info', compact('user'));
    }

    public function delete(User $user) {

        //Elimina los numeros asociados al usuario antes de eliminar al usuario.
        foreach ($user->number as $number) {
            $number->delete();
        }
        $user->delete();
        return redirect()->route('division.usersList');
    }
    public function update(User $user){

        $this->validate(request(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:divisions|unique:users',
            'rut' => 'integer|unique:users'
        ]);

        //column es el dato que se quiere cambiar del usuario, e input es el nuevo valor de ese dato.
        $column = Input::get('column');
        $input = Input::get($column);

        $user->$column = $input;
        $user->save();
        return redirect()->route('division.userInfo', $user->id);
    }
}