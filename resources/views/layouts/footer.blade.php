<footer class="page-footer font-small pt-5">
    <div class="container">
        <div class="text-center text-md-left">
            <div class="row">
                <div class="col-md-4 mx-auto d-flex flex-column">
                    <h5 class="font-weight-bold mt-3 mb-4">Nous contacter</h5>
                    <span>Envoyer un mail à <br><b>contact@escalade-montesquieu.fr</b></span>
                    <!-- <span>Appeler le <b>06 00 00 00 00</b></span> -->
                    <a href="informations">Plus d'informations</a>
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
                                <a class="link" href="{{ route('showForum', $forum->slug) }}">{{$forum->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr class="clearfix w-100 d-md-none">
                <div class="col-md-2 mx-auto">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">à propos</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('informations') }}">Informations</a>
                        </li>
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
        <div class="footer-copyright d-flex justify-content-between pb-3">
            <a href="https://arthaud.dev/" target="blank">Développé par Arthaud Proust</a>
            <span>© 2020 escalade-montesquieu.fr</span>
        </div>
    </div>
</footer>
