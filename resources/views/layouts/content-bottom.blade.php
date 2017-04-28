@extends('layouts.app')

@section('content')
    <h2>Notícias</h2>
    <div class="list-group">
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">List group item heading</h4>
            <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed
                diam eget risus varius blandit.</p>
        </a>
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">List group item heading</h4>
            <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed
                diam eget risus varius blandit.</p>
        </a>
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">List group item heading</h4>
            <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed
                diam eget risus varius blandit.</p>
        </a>
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">List group item heading</h4>
            <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed
                diam eget risus varius blandit.</p>
        </a>
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">List group item heading</h4>
            <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed
                diam eget risus varius blandit.</p>
        </a>
    </div>

    <div class="row col-md-12">
        <ul class="pagination">
            <li class="disabled"><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>


    <div id="redes-sociais" class="row">
        <div id="youtube" class="col-md-6">
            <div class="vid">
                <iframe width="360" height="300" src="//www.youtube.com/embed/m8LMOwrWHhQ"
                        allowfullscreen=""></iframe>
            </div>
        </div>

        <div id="facebook" class="col-md-6">
            <iframe id="facebook-feed"
                    src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FHeroDestiny7.54&width=360&height=300&show_faces=true&colorscheme=light&stream=true&border_color&header=true"
                    scrolling="no" frameborder="0"
                    style="border:none; overflow:hidden; width:360px; height:300px;"
                    allowTransparency="true"></iframe>
        </div>
    </div>
@stop

