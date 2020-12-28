@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', 'Mentions légales')
@section('content')
<div class="AboutLayout container">
    <div class="col-md-10">
        <h1 class="AboutLayout-title">Mentions légales</h1>
        <hr>

        <section class="AboutLayout-section">
            <h2>Présentation du site internet</h2>
            <p>
                Propriétaire du site : Arthaud PROUST
                <br>Le propriétaire est un particulier, domiciliant au 15 rue andré malraux 33520 Bruges. Il est possible de le contacter à l'adresse proust@arthaud.dev
            </p>
            <p>
                Hébergeur du site : OVH
                <br>Siège social: 2 rue Kellermann - 59100 Roubaix - France
            </p>
            <p></p>
        </section>
        <section class="AboutLayout-section">
            <h2>Cookies</h2>
            <p class="AboutLayout-small">
                Un « cookie » est un petit fichier d’information envoyé sur le navigateur de l’Utilisateur et
                enregistré au sein du terminal de l’Utilisateur (ex : ordinateur, smartphone), (ci-après «
                Cookies »).
            </p>
            <p>
                En naviguant sur le site sans vous connecter, aucun cookie concernant vos données personnelles ne sont utilisés. 
                <br>Seuls des cookies nécessaires au bon fonctionnenement du site sont utilisés (cookies de session utilisateur), et ce à partir du moment où l'utilisateur se connecte à son compte.
            </p>
            <p>
                Lors de son inscription, l'Utilisateur accepte par les <a href="{{route('conditionsUtilisation')}}">Conditions d'utilisation</a> qu'un cookie de session soit utilisé pour faciliter sa navigation sur le Site.
                Les Cookies ne risquent en aucun cas d’endommager le terminal de l’Utilisateur.
            </p>
            <p>
                En cliquant sur les icônes dédiées aux réseaux sociaux Twitter, Facebook, Linkedin
                et Google Plus pouvant figurer sur le Site, Twitter, Facebook, Linkedin et Google Plus
                peuvent également déposer des cookies sur vos terminaux (ordinateur, tablette, téléphone
                portable).
                <br>Ces types de cookies ne sont déposés sur vos terminaux qu’à condition que vous y
                consentiez, en continuant votre navigation sur le Site.
                <br>À tout moment, l’Utilisateur peut néanmoins revenir sur son
                consentement à ce que Twitter, Facebook, Linkedin et Google Plus dépose ce type de cookies.
            </p>
        </section>
        <section class="AboutLayout-section">
            <h2>Utilisation des données personnelles</h2>
            <p>Les mentions relatives à l'utilisation des données personnelles sont regroupées dans notre <a href="{{route('politiqueRgpd') }}">politique RGPD.</a></p>
    </div>
</div>
@endsection