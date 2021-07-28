<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Painel\Estilo;
use App\User;
use Validator;

class UserController extends StandardController
{
    protected $model;
    protected $nameView = 'painel.users';
    protected $redirectCad = '/painel/user/cadastrar';
    protected $redirectEdit = '/painel/user/editar';
    protected $route = '/painel/usuarios';
    protected $request;

    public function __construct(User $user, Request $request)
    {
        $this->model = $user;
        $this->request = $request;
    }

    //Faz o cadastro
    public function cadGo()
    {
        //Recupera os dados do formulario
        $dadosForm = $this->request->all();

        //Valida os dados
        $validator = Validator::make($dadosForm, $this->model->rules);

        if($validator->fails()){
            return redirect($this->redirectCad)
                ->withErrors($validator)
                ->withInput();
        }

        //criptografar a senha
        $dadosForm['password'] = bcrypt($dadosForm['password']);

        //Faz o insert
        $insert = $this->model->create($dadosForm);

        //Verifica se deu tudo certo
        if( $insert )
            return redirect($this->route);
        else
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
    }

    //Editando o item
    public function editGo($id)
    {
        //Recupera os dados do formulario em forma de array
        $dadosForm = $this->request->all();

        //Regras especiais
        $rules = [
        'name'      => 'required|min:3|max:100',
        'email'     => "required|email|min:3|max:100|unique:users,email,{$id}",
        'password'  => 'min:3|max:20',
    ];

        //valida os dados antes de editar
        $validator = Validator::make($dadosForm, $rules);

        if($validator->fails()){
            return redirect("{$this->redirectEdit}/$id")
                ->withErrors($validator)
                ->withInput();
        }

        //Recupera o item pelo seu id
        $item = $this->model->find($id);

        //criptografar a senha
        if( strlen($dadosForm['password']) > 0 )
            $dadosForm['password'] = bcrypt($dadosForm['password']);
        else
            unset($dadosForm['password']);

        //Faz a edição do item
        $update = $item->update($dadosForm);

        //Verifica se editou com sucesso
        if( $update )
            return redirect($this->route);
        else
            return redirect("{$redirectEdit}/$id")
                ->withErrors(['errors' => 'Falha ao editar'])
                ->withInput();

    }

    //Faz a pesquisa
    public function pesquisar()
    {
        //Recupera a palavra de pesquisa
        $palavraPesquisa = $this->request->get('pesquisar');

        //Filtra os dados de acordo com a palavra de pesquisa
        $data = $this->model
            ->where('name', 'LIKE', "%$palavraPesquisa%")
            ->orWhere('email', 'LIKE', $palavraPesquisa)
            ->paginate(10);

        //mostra a view
        return view("{$this->nameView}.index", compact('data'));
    }

}
