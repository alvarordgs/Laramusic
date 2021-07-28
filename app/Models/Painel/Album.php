<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';

    protected $fillable = [
        'id_estilo',
        'nome',
        'imagem'
    ];

    public $rules = [
        'id_estilo'  => 'required',
        'nome'       => 'required|min:3|max:100',
        'imagem'     => 'required|image|max:10000|mimes:jpg,png,jpeg',
    ];

    public $rulesEdit = [
        'id_estilo'  => 'required',
        'nome'       => 'required|min:3|max:100',
        'imagem'     => 'image|max:10000|mimes:jpg,png,jpeg',
    ];

    public $rulesVincMusic = [
        'musicas' => 'required',
    ];

    public function musicas()
    {
        return $this->belongsToMany('App\Models\Painel\Musica', 'albums_musicas', 'id_album', 'id_musica');
    }


}
