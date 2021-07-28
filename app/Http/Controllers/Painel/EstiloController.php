<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Painel\Estilo;
use App\Models\Painel\Album;
use Validator;

class EstiloController extends StandardController
{
    protected $model;
    protected $nameView = 'painel.estilos';
    protected $redirectCad = '/painel/estilos/cadastrar';
    protected $redirectEdit = '/painel/estilos/editar';
    protected $route = '/painel/estilos';
    protected $request;

    public function __construct(Estilo $estilo, Request $request)
    {
        $this->model = $estilo;
        $this->request = $request;
    }

    public function delete($id)
    {
        $qtdAlbuns = Album::where('id_estilo', $id)->count();

        if( $qtdAlbuns > 0){
            return redirect('painel/estilos')
                ->with('errors',['Falha ao deletar. Esse estilo esta em uso!']);
        }else {
            //Recupera o item pelo seu id
            $item = $this->model->find($id);

            //Deleta o item
            $item->delete();

            //Redireciona
            return redirect($this->route);
        }
    }

}
