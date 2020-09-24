<footer class="page-footer font-small pt-md-5 pt-4">
    <div class="container px-5 px-md-0">
        <div class="text-left text-md-left">
            <div class="row ">
                <div class="col-md-4 mx-auto d-flex flex-column mb-3">
                    <h5 class="font-weight-bold mt-3 mb-md-4">Nous contacter</h5>
                    <span>Envoyer un mail à <br><b>contact@escalade-montesquieu.fr</b></span>
                    <span>Ou voir <b>M.Granier</b> au lycée</span>
                    <!-- <a href="informations">Plus d'informations</a> -->
                </div>
                <!-- <hr class="clearfix w-100 d-md-none"> -->
                <div class="col-md-2 mx-auto">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-md-4">Évènements et sorties</h5>
                    <ul class="list-unstyled">
                        @foreach(Session::get('blog_list'); as $blog)
                            <li>
                                <a href="{{ route('showBlog', $blog->slug) }}">{{$blog->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- <hr class="clearfix w-100 d-md-none"> -->
                <div class="col-md-2 mx-auto">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-md-4">Forum</h5>
                    <ul class="list-unstyled">
                        @foreach(Session::get('forum_list'); as $forum)
                            <li>
                                <a class="link" href="{{ route('showForum', $forum->slug) }}">{{$forum->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- <hr class="clearfix w-100 d-md-none"> -->
                <div class="col-md-2 mx-auto">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-md-4">photos</h5>
                    <ul class="list-unstyled mb-md-4">
                        <li>
                            <a href="{{route('galleries') }}">Galerie photo</a>
                        </li>
                    </ul>
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-md-4">à propos</h5>
                    <ul class="list-unstyled">
                        <!-- <li>
                            <a href="{{ route('informations') }}">Informations</a>
                        </li> -->
                        <li>
                            <a href="{{ route('mentionsLegales') }}">Mentions légales</a>
                        </li>
                        <li>
                            <a href="{{ route('conditionsUtilisation') }}">Conditions d'utilisation</a>
                        </li>
                        <li>
                            <a href="{{route('politiqueRgpd') }}">Politique RGPD</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer-copyright d-flex flex-column flex-md-row justify-content-between pb-3">
            <a href="https://arthaud.dev/" target="blank">Développé par Arthaud Proust</a>
            <span>© 2020 escalade-montesquieu.fr</span>
        </div>
    </div>
</footer>
