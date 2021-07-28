<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator;

class StandardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $totalPorPag = 10;

    //Lista dos itens
    public function index()
    {
        //Recupera todos os estilos musicais cadastrados
        $data = $this->model->paginate($this->totalPorPag);

        return view("{$this->nameView}.index", compact('data'));
    }

    //Exibe o formulario de cadastro
    public function cad()
    {
        return view("{$this->nameView}.cad-edit");
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

    //Exibe o formulario de edição
    public function edit($id)
    {
        //Recupera o item pelo seu id
        $data = $this->model->find($id);

        return view("{$this->nameView}.cad-edit", compact('data'));
    }

    //Editando o item
    public function editGo($id)
    {
        //Recupera os dados do formulario em forma de array
        $dadosForm = $this->request->all();

        //valida os dados antes de editar
        $validator = Validator::make($dadosForm, $this->model->rules);

        if($validator->fails()){
            return redirect("{$redirectEdit}/$id")
                ->withErrors($validator)
                ->withInput();
        }

        //Recupera o item pelo seu id
        $item = $this->model->find($id);

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

    //Deleta um registro
    public function delete($id)
    {
        //Recupera o item pelo seu id
        $item = $this->model->find($id);

        //Deleta o item
        $deleta = $item->delete();

        //Redireciona
        return redirect($this->route);
    }

    //Faz a pesquisa
    public function pesquisar()
    {
        //Recupera a palavra de pesquisa
        $palavraPesquisa = $this->request->get('pesquisar');

        //Filtra os dados de acordo com a palavra de pesquisa
        $data = $this->model->where('nome', 'LIKE', "%$palavraPesquisa%")->paginate(10);

        //mostra a view
        return view("{$this->nameView}.index", compact('data'));
    }
}