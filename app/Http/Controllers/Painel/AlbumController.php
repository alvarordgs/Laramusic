<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Painel\Album;
use App\Models\Painel\Estilo;
use App\Models\Painel\Musica;
use Validator;

class AlbumController extends StandardController
{
    protected $model;
    protected $nameView = 'painel.albuns';
    protected $redirectCad = '/painel/album/cadastrar';
    protected $redirectEdit = '/painel/album/editar';
    protected $route = '/painel/albuns';
    protected $request;

    public function __construct(Album $album, Request $request)
    {
        $this->model = $album;
        $this->request = $request;
    }

    public function index()
    {
        //Recupera todos os estilos musicais cadastrados
        //$data = $this->model->paginate($this->totalPorPag);
        $data = $this->model
            ->join('estilos', 'estilos.id', '=', 'albums.id_estilo')
            ->select('albums.nome', 'albums.id', 'estilos.nome as estilo')
            ->paginate($this->totalPorPag);

        return view("{$this->nameView}.index", compact('data'));
    }

    //Exibe o formulario de cadastro
    public function cad()
    {
        //Recupera os estilos musicais
        $estilos = Estilo::get();

        return view("{$this->nameView}.cad-edit", compact('estilos'));
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
        $imagem = $this->request->file('imagem');

        //Define o caminho
        $path = public_path('assets/uploads/imgs/albuns');

        //Define o nome da imagem
        $nomeImagem = date('YmdHis').'.'.$imagem->getClientOriginalExtension();
        $dadosForm['imagem'] = $nomeImagem;

        //Faz o upload da imagem
        $upload = $imagem->move($path, $nomeImagem);

        if( !$upload )
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();

        //Faz o insert
        $insert = $this->model->create($dadosForm);

        //Verifica se deu tudo certo
        if( $insert )
            return redirect("/painel/album/{$insert->id}/musicas/cadastrar");
        else
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
    }

    //Exibe o formulario de edição
    public function edit($id)
    {
        //Recupera os estilos musicais
        $estilos = Estilo::get();

        //Recupera o item pelo seu id
        $data = $this->model->find($id);

        return view("{$this->nameView}.cad-edit", compact('data', 'estilos'));
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
        if( $this->request->hasFile('imagem') && $this->request->file('imagem')->isValid() ){

            //Recupera o campo de upload
            $imagem = $this->request->file('imagem');

            //Define o caminho
            $path = public_path('assets/uploads/imgs/albuns');

            //Define o nome da imagem
            $nomeImagem = $item->imagem;

            //Faz o upload da imagem
            $upload = $imagem->move($path, $nomeImagem);

            if( !$upload )
                return redirect("$this->redirectEdit/$id")
                    ->withErrors(['errors' => 'Falha ao cadastrar'])
                    ->withInput();

        }

        //Faz a edição do item
        $dadosForm['imagem'] = $item->imagem;
        $update = $item->update($dadosForm);


        //Verifica se editou com sucesso
        if( $update )
            return redirect($this->route);
        else
            return redirect("{$this->redirectEdit}/$id")
                ->withErrors(['errors' => 'Falha ao editar'])
                ->withInput();

    }

    //Faz a pesquisa
    public function pesquisar()
    {
        //Recupera a palavra de pesquisa
        $palavraPesquisa = $this->request->get('pesquisar');

        //Filtra os dados de acordo com a palavra de pesquisa
        //$data = $this->model->where('nome', 'LIKE', "%$palavraPesquisa%")->paginate(10);
        $data = $this->model
            ->join('estilos', 'estilos.id', '=', 'albums.id_estilo')
            ->select('albums.nome', 'albums.id', 'estilos.nome as estilo')
            ->where('albums.nome', 'LIKE', "%$palavraPesquisa%")
            ->orWhere('estilos.nome', 'LIKE', "%$palavraPesquisa%")
            ->paginate($this->totalPorPag);

        //mostra a view
        return view("{$this->nameView}.index", compact('data'));
    }


    public function musicas($id){

        //Recupera o album
        $album = $this->model->find($id);

        //Recupera as musicas do album
        $musicas = $album->musicas;

        return view('painel.albuns.musicas', compact('musicas', 'album')) ;
    }

    public function musicasCadastrar($id, Musica $musica)
    {
        //Recupera as informações do album
        $album = $this->model->find($id);

        //Recupera as musicas
        $musicas = $musica->whereNotIn('id', function($query) use ($id){
            $query->select('albums_musicas.id_musica');
            $query->from('albums_musicas');
            $query->whereRaw("albums_musicas.id_album = ".$id);
        })->get();

        return view('painel.albuns.vinc_musicas', compact('musicas', 'album'));
    }

    public function musicasCadastrarGo($id)
    {
        //Recupera as musicas
        $musicas = $this->request->get('musicas');

        //Recupera o album
        $album = $this->model->find($id);

        //valida os dados antes de editar
        $validator = Validator::make($this->request->all(), $this->model->rulesVincMusic);

        if($validator->fails()){
            return redirect("/painel/album/{$id}/musicas/cadastrar")
                ->withErrors($validator)
                ->withInput();
        }

        //Vincula as musica ao album
        $album->musicas()->attach($musicas);

        return redirect("/painel/album/musicas/{$id}");
    }


    public function deletarMusicaAlbum($idAlbum, $idMusica)
    {
        //Recupera o album pelo seu id
        $album = $this->model->find($idAlbum);

        //Recupera o objeto de musicas albuns
        $musicas = $album->musicas()->detach($idMusica);

        return redirect("/painel/album/musicas/{$idAlbum}");
    }

    public function musicaPesquisar($id)
    {
        //Recupera o album
        $album = $this->model->find($id);

        //Recupera as musicas do album
        $musicas = $album
            ->musicas()
            ->where('musicas.nome', 'LIKE', "%{$this->request->get('pesquisar')}%")
            ->get();

        return view('painel.albuns.musicas', compact('musicas', 'album')) ;

    }

    public function pesquisarMusicaAdd($id, Musica $musica)
    {
        //Recupera as informações do album
        $album = $this->model->find($id);

        //Recupera as musicas
        $musicas = $musica->whereNotIn('id', function($query) use ($id){
            $query->select('albums_musicas.id_musica');
            $query->from('albums_musicas');
            $query->whereRaw("albums_musicas.id_album = ".$id);
        })
            ->where('nome', 'LIKE', "%{$this->request->get('pesquisar')}%")
            ->get();

        return view('painel.albuns.vinc_musicas', compact('musicas', 'album'));
    }

    public function deleteAlbum($id)
    {
        $qtdMusicasAlbum = Album::find($id)->musicas()->count();

        if( $qtdMusicasAlbum > 0 )
            return redirect()->back()
                ->with('errors', ['Falha ao deletar. O álbum está em uso!']);

        //Recupera o item pelo seu id
        $item = $this->model->find($id);

        //Deleta o item
        $deleta = $item->delete();

        //Redireciona
        return redirect($this->route);

    }

}
