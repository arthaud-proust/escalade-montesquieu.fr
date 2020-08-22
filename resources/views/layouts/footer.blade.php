<footer class="page-footer font-small pt-5">
    <div class="container">
        <div class="text-center text-md-left">
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <h5 class="font-weight-bold mt-3 mb-4">La section d'escalade à montesquieu</h5>
                    <p>Les grimpeurs de la section font de l'escalade régulièrement, entre midi et deux et lors des nombreuses sorties.<br>
                    À la fin de l'année, un stage d'escalade est organisé pour réunir les plus motivés et aller grimper en falaise durant quelques jours.</p>
                </div>
                <hr class="clearfix w-100 d-md-none">
                <div class="col-md-2 mx-auto">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Blog</h5>
                    <ul class="list-unstyled">
                        @foreach(Session::get('blog_list'); as $blog)
                            <li>
                                <a href="{{ route('showBlog', $blog->slug) }}">{{$blog->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr class="clearfix w-100 d-md-none">
                <div class="col-md-2 mx-auto">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Forum</h5>
                    <ul class="list-unstyled">
                        @foreach(Session::get('forum_list'); as $forum)
                            <li>
                                <a class="link" href="{{ route('showBlog', $forum->slug) }}">{{$forum->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr class="clearfix w-100 d-md-none">
                <div class="col-md-2 mx-auto">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">à propos</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Nous contacter</a>
                        </li>
                        <li>
                            <a href="#!">Mentions légales</a>
                        </li>
                        <li>
                            <a href="#!">Règlement RGPD</a>
                        </li>
                        <li>
                            <a href="#!"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <ul class="list-unstyled list-inline text-center py-2">
                <li class="list-inline-item">
                    <h5 class="mb-1">Rejoignez la section escalade</h5>
                </li>
                <li class="list-inline-item">
                    <a href="#!" class="btn btn-success btn-rounded">S'inscrire</a>
                    <a href="#!" class="btn btn-link">J'ai un compte</a>
                </li>
        </ul>
        <hr>
        <div class="footer-copyright d-flex justify-content-between py-3">
            <a href="https://arthaud.dev/" target="blank">Développé par Arthaud Proust</a>
            <span>© 2020 Tous droits réservés <a href="https://escalade-montesquieu.fr/">escalade-montesquieu.fr</a></span>
        </div>
    </div>
</footer>