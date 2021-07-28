<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Musica extends Model
{
    protected $fillable = ['nome', 'nome_arq'];

    public $rules = [
        'nome' => 'required|min:3|max:100',
        'nome_arq' => 'required|max:30000|mimeTypes:audio/mp3,audio/mpeg,mp3',
    ];

    public $rulesEdit = [
        'nome' => 'required|min:3|max:100',
        'nome_arq' => 'max:30000|mimeTypes:audio/mp3,audio/mpeg,mp3',
    ];

    public function albuns()
    {
        return $this->belongsToMany('App\Models\Painel\Album', 'albums_musicas', 'id_musica', 'id_album');
    }
}
