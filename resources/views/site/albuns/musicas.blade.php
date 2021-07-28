@extends('site.templates.template')

@section('content')

    <div class="container">
        <div id="jquery_jplayer_2" class="jp-jplayer"></div>
        <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player">
            <div class="jp-type-playlist">
                <div class="jp-gui jp-interface">
                    <div class="jp-controls">
                        <button class="jp-previous" role="button" tabindex="0">previous</button>
                        <button class="jp-play" role="button" tabindex="0">play</button>
                        <button class="jp-next" role="button" tabindex="0">next</button>
                        <button class="jp-stop" role="button" tabindex="0">stop</button>
                    </div>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>
                    <div class="jp-volume-controls">
                        <button class="jp-mute" role="button" tabindex="0">mute</button>
                        <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                    </div>
                    <div class="jp-time-holder">
                        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                    </div>
                    <div class="jp-toggles">
                        <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                        <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
                    </div>
                </div>
                <div class="jp-playlist">
                    <ul>
                        <li>&nbsp;</li>
                    </ul>
                </div>
                <div class="jp-no-solution">
                    <span>Update Required</span>
                    To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-header')
    <script>
        //<![CDATA[
        $(document).ready(function(){

            new jPlayerPlaylist({
                jPlayer: "#jquery_jplayer_1",
                cssSelectorAncestor: "#jp_container_1"
            }, [
                {
                    title:"{{$album->nome}}",
                    artist:"",
                    free:true,
                    m4v:"http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v",
                    ogv:"http://www.jplayer.org/video/ogv/Big_Buck_Bunny_Trailer.ogv",
                    webmv: "http://www.jplayer.org/video/webm/Big_Buck_Bunny_Trailer.webm",
                    poster:"http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png"
                },
                {
                    title:"Finding Nemo Teaser",
                    artist:"Pixar",
                    m4v: "http://www.jplayer.org/video/m4v/Finding_Nemo_Teaser.m4v",
                    ogv: "http://www.jplayer.org/video/ogv/Finding_Nemo_Teaser.ogv",
                    webmv: "http://www.jplayer.org/video/webm/Finding_Nemo_Teaser.webm",
                    poster: "http://www.jplayer.org/video/poster/Finding_Nemo_Teaser_640x352.png"
                },
                {
                    title:"Incredibles Teaser",
                    artist:"Pixar",
                    m4v: "http://www.jplayer.org/video/m4v/Incredibles_Teaser.m4v",
                    ogv: "http://www.jplayer.org/video/ogv/Incredibles_Teaser.ogv",
                    webmv: "http://www.jplayer.org/video/webm/Incredibles_Teaser.webm",
                    poster: "http://www.jplayer.org/video/poster/Incredibles_Teaser_640x272.png"
                }
            ], {
                swfPath: "../../dist/jplayer",
                supplied: "webmv, ogv, m4v",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: true
            });

            new jPlayerPlaylist({
                jPlayer: "#jquery_jplayer_2",
                cssSelectorAncestor: "#jp_container_2"
            }, [
                @foreach( $musicas as $musica )
                {
                    title:"{{$musica->nome}}",
                    mp3:'{{url("/assets/uploads/musics/{$musica->nome_arq}")}}',
                },
                @endforeach
            ], {
                swfPath: "../../dist/jplayer",
                supplied: "oga, mp3",
                wmode: "window",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: true
            });
        });
        //]]>
    </script> <!-- Fim do jPlayer -->
@endpush