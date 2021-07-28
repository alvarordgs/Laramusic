@extends('site.templates.template')

@section('content')

    <section class="albuns">
        <div class="container">

            <h1 class="title">
                Últimos Álbuns:
            </h1>

            <div class="list-albuns col-md-12">
                <div class="row">

                    @forelse( $albuns as $album)
                        <article class="col-md-3 albun">
                            <a href="/albuns/{{$album->id}}">
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
                        <div class="col-md12">
                            <p>Não existem albuns cadastrados!</p>
                        </div>
                    @endforelse

                </div>
            </div> <!-- List Albuns-->

        </div> <!-- End Container-->
    </section> <!-- End Albuns-->

    <div class="clear"></div>

    <hr class="hr">

    <section class="estilos">
        <div class="container">

            <h1 class="title">Estilos:</h1>

            <div class="estilos-mu col-md-12">
                @forelse( $estilos as $estilo)
                    <a href="{{url("/estilo/{$estilo->id}")}}" class="estilo">
                        {{$estilo->nome}}
                    </a>
                @empty
                    <p>Não existem estilos cadastrados!</p>
                @endforelse
            </div> <!--End estilos-mu-->

        </div> <!-- End Container -->
    </section> <!-- End estilos -->

@endsection