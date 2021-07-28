<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Painel\Musica;
use App\Models\Painel\Album;
use Validator;

class MusicaController extends StandardController
{
    protected $model;
    protected $nameView = 'painel.musicas';
    protected $redirectCad = '/painel/musica/cadastrar';
    protected $redirectEdit = '/painel/musica/editar';
    protected $route = '/painel/musicas';
    protected $request;

    public function __construct(Musica $musica, Request $request)
    {
        $this->model = $musica;
        $this->request = $request;
    }

    public function cadMusica()
    {
        $albuns = Album::all();

        return view('painel.musicas.cad-edit', ['albuns'=>$albuns]);
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

        //Recupera o campo de upload
        $musica = $this->request->file('nome_arq');

        //Define o caminho
        $path = public_path('/assets/uploads/musics');

        //Define o nome da musica
        $nomeMusica = date('YmdHis').'.'.$musica->getClientOriginalExtension();
        $dadosForm['nome_arq'] = $nomeMusica;

        //Faz o upload das musicas
        $upload = $musica->move($path, $nomeMusica);

        if( !$upload )
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();

        $albunschecked = $dadosForm['albuns'];

        if($musicaInserida = $this->model->create($dadosForm)){
            foreach( $albunschecked as $checked ){
                \DB::table('albums_musicas' )
                    ->insert([
                        'id_album' => $checked,
                        'id_musica' => $musicaInserida->id
                    ]);
            }
            return redirect($this->route);
        }else{
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
        }

        /*//Faz o insert
        $insert = $this->model->create($dadosForm);

        //Verifica se deu tudo certo
        if( $insert )
            return redirect($this->route);
        else
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();*/
    }

    public function edit($id) {

        $albuns = Album::all();

        $nomeMusica = Musica::find($id);

        $albuns_checked = Musica::find($id)->albuns()->get();

        $albuns_musica = [];

        foreach($albuns_checked as $key => $value) {
            $albuns_musica[$key] = $value['id'];
        }

        $data = [
            'albuns' => $albuns,
            'albuns_checked' => $albuns_musica,
            'data' => $nomeMusica,
        ];

        return view('painel.musicas.cad-edit', $data);
    }

    //Editando o item
    public function editGo($id)
    {
        //Recupera os dados do formulario em forma de array
        $dadosForm = $this->request->all();

        //valida os dados antes de editar
        $validator = Validator::make($dadosForm, $this->model->rulesEdit);

        if($validator->fails()){
            return redirect("{$this->redirectEdit}/$id")
                ->withErrors($validator)
                ->withInput();
        }

        //Recupera o item pelo seu id
        $item = $this->model->find($id);

        //Verifica se existe o arquivo para o upload
        if( $this->request->hasFile('nome_arq') && $this->request->file('nome_arq')->isValid() ){

            //Recupera o campo de upload
            $musica = $this->request->file('nome_arq');

            //Define o caminho
            $path = public_path('assets/uploads/musics');

            //Define o nome da musica
            $nomeMusica = $item->nome_arq;

            //Faz o upload das musicas
            $upload = $musica->move($path, $nomeMusica);

            if( !$upload )
                return redirect("$this->redirectEdit/$id")
                    ->withErrors(['errors' => 'Falha ao cadastrar'])
                    ->withInput();

        }

        //Faz a edição do item
        $dadosForm['nome_arq'] = $item->nome_arq;
        $update = $item->update($dadosForm);

        //Verifica se editou com sucesso
        if( $update )
            return redirect($this->route);
        else
            return redirect("{$this->redirectEdit}/$id")
                ->withErrors(['errors' => 'Falha ao editar'])
                ->withInput();

    }

    public function deletarMusica($id)
    {
        $qtdAlbumMusicas = Musica::find($id)->albuns()->count();

        if( $qtdAlbumMusicas > 0 )
            return redirect()->back()
                ->with('errors', ['Falha ao deletar. A música está em uso!']);

        //Recupera o item pelo seu id
            $item = $this->model->find($id);

            //Deleta o item
            $deleta = $item->delete();

            //Redireciona
            return redirect($this->route);

    }

}
