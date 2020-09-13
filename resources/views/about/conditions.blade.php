@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', 'Conditions d\'utilisation')
@section('content')
<div class="AboutLayout container">
    <div class="col-md-10">
        <h1 class="AboutLayout-title">Conditions d'utilisation</h1>
        <hr>

        <section class="AboutLayout-section">
            <h2>Objet et définitions</h2>
            <p>
                Les présentes « conditions générales d'utilisation » ont pour objet l'encadrement juridique de l’utilisation du site <b>escalade-montesquieu.fr</b> et de ses services.
            <p>
            <p>
                Ce contrat est conclu entre :
                <ul>
                    <li>Le gérant du site internet, ci-après désigné « l’Éditeur »
                    <li>Toute personne physique ou morale souhaitant accéder au site et à ses services, ci-après appelé « l’Utilisateur ».
                    <li>Tout Utilisateur s'étant identifié à l’aide de ses identifiants de connexion, ci-après appelé « Membre ».
                </ul>
                L'accès au site vaut acceptation de présentes conditions d'utilisation.
            </p>
        </section>

        <section class="AboutLayout-section">
            <h2>Mentions légales</h2>
            <p>
                Les mentions légales du site sont accessible <a href="{{ route('mentionsLegales') }}">ici</a>.
            </p>
        </section>

        <section class="AboutLayout-section">
            <h2>Accès aux services</h2>
            <p>
                L’Utilisateur du site <b>escalade-montesquieu.fr</b> a accès aux services suivants :
                <ul>
                    <li>Agenda des évènement et sorties</li>
                    <li>Informations générales sur la section escalade</li>
                </ul>
            </p>
            <p>
                Tout Utilisateur ayant accès a internet peut accéder gratuitement et depuis n’importe où au site. Les frais supportés par l’Utilisateur pour y accéder (connexion internet, matériel informatique, etc.) ne sont pas à la charge de l’Éditeur.
            </p>    
            <p>
                Les services suivants ne sont accessible pour l’Utilisateur que s’il est <b>Membre</b> du site (c’est-à-dire qu’il s'est identifié à l’aide de ses identifiants de connexion):
                <ul>
                    <li>Participation à un évènement ou une sortie</li>
                    <li>Forum de discussion</li>
                </ul>
            </p>
            <p>
                Le site et ses différents services peuvent être interrompus ou suspendus par l’Éditeur, notamment à l’occasion d’une maintenance, sans obligation de préavis ou de justification.
            </p>
        </section>
        
        <section class="AboutLayout-section">
            <h2>Responsabilité de l’Utilisateur</h2>
            <p>
                L'Utilisateur est responsable des risques liés à l’utilisation de son identifiant de connexion et de son mot de passe. 
                Le mot de passe de l’Utilisateur doit rester secret. En cas de divulgation de mot de passe, l’Éditeur décline toute responsabilité.
            </p>
            <p>
                L'Utilisateur s'engage à communiquer sa véritable identitée lors de son inscription, et à ne pas usurper l'identité d'un tiers en modifiant le nom de son compte.
                La possibilitée de changer son prénom est conservée en cas d'erreur de frappe lors de l'inscription.
            </p>
            <p>
                L’Utilisateur assume l’entière responsabilité de l’utilisation qu’il fait des informations et contenus présents sur le site <b>escalade-montesquieu.fr</b>.
            </p>
            <p>
                Tout usage du service par l'Utilisateur ayant directement ou indirectement pour conséquence des dommages doit faire l'objet d'une indemnisation au profit du site.
            </p>
            <p>
                Le site permet aux Membres de publier sur le site :
                <ul>
                    <li>Messages</li>
                    <li>Liens</li>
                    <li>Photo de profil</li>
                </ul>
                Le Membre s’engage à tenir des propos respectueux des autres et de la loi et accepte que ces publications soient modérées ou refusées par l’Éditeur, sans obligation de justification. 
                <br>Aussi, la publication d’un commentaire ou d’un article sur le site ou nos réseaux sociaux, de type raciste, homophobe, ou discours incitant à la haine est prohibé et sera immédiatement supprimé. Ce dernier pourra, au regard de la loi française faire l’objet de sanctions ou de poursuite judiciaires à l'encontre de l'Utilisateur.
            </p>
            <p>
                En publiant sur le site, l’Utilisateur cède à la société éditrice le droit non exclusif et gratuit de représenter, reproduire, adapter, modifier, diffuser et distribuer sa publication, directement ou par un tiers autorisé.
            </p>
        </section>
        <section class="AboutLayout-section">
            <h2>Responsabilité de l’Éditeur</h2>
            <p>
                Tout dysfonctionnement du serveur ou du réseau ne peut engager la responsabilité de l’Éditeur.
                De même, la responsabilité du site ne peut être engagée en cas de force majeure ou du fait imprévisible et insurmontable d'un tiers.
            </p>
            <p>
                Le site <b>escalade-montesquieu.fr</b> s'engage à mettre en œuvre tous les moyens nécessaires pour garantir la sécurité et la confidentialité des données. Toutefois, il n’apporte pas une garantie de sécurité totale.
                L’Éditeur se réserve la faculté d’une non-garantie de la fiabilité des sources, bien que les informations diffusées su le site soient réputées fiables.
            </p>
        </section>
        <section class="AboutLayout-section">
            <h2>Propriété intellectuelle</h2>
            <p>
                Les contenus du site <b>escalade-montesquieu.fr</b> (logos, textes, éléments graphiques, vidéos, etc.) sont protégés par le droit d’auteur, en vertu du Code de la propriété intellectuelle.
                Toute reproduction, copie ou publication de ces différents contenus sans l'autorisation préalable l’Éditeur du site est strictement interdite. L'Utilisateur s'engage à demander un accord écrit de l'Éditeur avant toute reproduction, copie ou publication de ces différents contenus.
            </p>
            <p>
                L’Utilisateur est entièrement responsable de tout contenu qu’il met en ligne et il s’engage à ne pas porter atteinte à un tiers.
            </p>
            <p>
                L’Éditeur du site se réserve le droit de modérer ou de supprimer librement et à tout moment les contenus mis en ligne par les utilisateurs, et ce sans justification.
            </p>
        </section>
        <section class="AboutLayout-section">
            <h2>Données personnelles</h2>
            <p>
                Voir aussi la <a target="blanck" href="{{ route('politiqueRgpd') }}">politique RGPD</a> du site.
            </p>
            <p>
                L’Utilisateur doit obligatoirement fournir des informations personnelles pour procéder à son inscription sur le site. 
                <br>L’adresse électronique (e-mail) de l’utilisateur pourra notamment être utilisée par le site Escalade Montesquieu pour la communication d’informations diverses (newsletter) et la gestion du compte.
                En aucun cas les informations personnelles ne sont cédées, vendues ou louées à un tiers.
                <br><b>escalade-montesquieu.fr</b> garanti le respect de la vie privée de l’utilisateur, conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés.
            </p>
            <p>
                <stroke>Le site est déclaré auprès de la CNIL sous le numéro suivant : .</stroke>
            </p>
            <p>
                En vertu des articles 39 et 40 de la loi en date du 6 janvier 1978, l'Utilisateur dispose d'un droit d'accès, de rectification, de suppression et d'opposition de ses données personnelles. L'Utilisateur exerce ce droit via :
                <ul>
                    <li>Un mail à proust@arthaud.dev</li>
                    <li>Par voie postale au 15 rue andré Malraux; 33520 Bruges</li>
                </ul>
            </p>
        </section>
        <section class="AboutLayout-section">
            <h2>Liens hypertextes</h2>
            <p>
                Les domaines vers lesquels mènent les liens hypertextes présents sur le site n’engagent pas la responsabilité de l’Éditeur de <b>escalade-montesquieu.fr</b>, qui n’a pas le contrôle total sur ces liens.
            </p>
            <p>
                Il est possible pour un tiers de créer un lien vers une page du site <b>escalade-montesquieu.fr</b> sans autorisation expresse de l’éditeur.
            </p>
        </section>
        <section class="AboutLayout-section">
            <h2>Évolution des conditions générales d’utilisation</h2>
            <p>
                Le site <b>escalade-montesquieu.fr</b> se réserve le droit de modifier les clauses de ces conditions d’utilisation à tout moment et sans justification.
            </p>
        </section>
        <section class="AboutLayout-section">
            <h2>Durée du contrat</h2>
            <p>
                La durée du présent contrat est indéterminée. Le contrat produit ses effets à l'égard de l'Utilisateur à compter du début de l’utilisation du service.
            </p>
        </section>
        <section class="AboutLayout-section">
            <h2>Droit applicable et juridiction compétente</h2>
            <p>
                Le présent contrat dépend de la législation française. 
                En cas de litige non résolu à l’amiable entre l’Utilisateur et l’Éditeur, les tribunaux de Bordeaux sont compétents pour régler le contentieux.
            </p>
        </section>
    </div>
</div>
@endsection
