<?php
namespace App\Repositories;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Helpers\CpfValidation;
use Illuminate\Support\Facades\Auth;

class UserRepository {
	
	 /**
     * Salva ou edita um usuário
     *
     * @param  \App\Http\Requests\UserRequest $request	
	 * @param  int id optional Caso seja passado um id, o método irá editar o usuário existente
     * @return \App\User em caso de sucesso ou false em caso de erro
     */
    public function save(UserRequest $request, $id = null)     
    {
        $user;
        
		if ($id == null) {
    		$user = new User();			
		} else {
			$user = User::findOrFail($id);
        }		
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');     
        $user->cpf = $request->input('cpf');  
        
        if ($request->input('password') != null) {
        	$user->password = Hash::make($request->input('password'));
        }
        if ($user->save()) {        	
            return $user;

        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {            
            return true;
        } else {
            return false;
        }
    }
}