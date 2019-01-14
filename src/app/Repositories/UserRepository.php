<?php
namespace App\Repositories;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserRepository {

    protected $minutes = 60;
    protected $key = 'user_';

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
            Cache::tags($this->key . $id)->flush();   
        }		
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');     
        $user->cpf = $request->input('cpf');  
        
        if ($request->input('password') != null) {
        	$user->password = Hash::make($request->input('password'));
        }
        if ($user->save()) {
            Cache::forget('users');

            if ($id !== null) {
                Cache::put($this->key . $id, $user, $this->minutes);                     
        	}
            
            return $user;
        } else {
            return false;
        }
    } 

     /**
     * Deleta um usuário
     *     
	 * @param  int $id Id do usuário que deve ser deletado
     * @return bool
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) { 
            Cache::forget('users');
            Cache::forget($this->key . $id);           
            return true;
        } else {
            return false;
        }
    }
    
     /**
     * Retorna todos os usuários   
     * @return \App\User
     */
    public function getAll()
    {        
        return Cache::remember('users', $this->minutes, function () {
            return User::all();
        });
    }

    /**
     * Retorna um usuário especifico
     *     
     * @param  int id $id do usuário
     * @return \App\User em caso de sucesso, caso não encontre 404
     */
    public function get($id)
    {
        return Cache::remember($this->key . $id, $this->minutes, function () use ($id) {
            return User::findOrFail($id);
        });
    }   
}