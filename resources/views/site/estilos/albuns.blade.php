@extends('site.templates.template')

@section('content')

    <section class="estilo-selected">
        <div class="container">
            <h1 class="title">{{$estilos->nome}}</h1>

            <div class="list-albuns col-md-12">
                <div class="row">
                    @forelse( $albuns as $album)
                        <article class="col-md-3 albun">
                            <a href="{{url("/album/{$album->id}")}}">
                                <div class="image-albun">
                                    <img src="{{url("assets/uploads/imgs/albuns/{$album->imagem}")}}" alt="{{$album->nome}}" class="img-albun">
                                    <div class="hover-img-albun">
                                        <i class="fa fa-headphones" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <h1 class="title-albun">{{$album->nome}}</h1>
                            </a>
                        </article>
                    @empty
                        <div class="col-md-12">
                            <p>Não existem álbuns para este estilo música!</p>
                        </div>
                    @endforelse
                </div>
            </div> <!-- List Albuns-->
        </div>
    </section>

@endsection