<?php
include("includes/header.php");
?>

<link rel="stylesheet" href="mention-legale.css">
<main class="legal-page">

    <section class="page-title">
        <h1>Mentions légales</h1>
        <p>Informations légales concernant la plateforme.</p>
    </section>

    <section class="legal-content">

        <div class="legal-card legal-card--editor">
            <div class="legal-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div class="legal-card__body">
                <h2>Éditeur du site</h2>
                <p>Ce site est un projet étudiant réalisé dans le cadre d'un projet scolaire pour l'Université Gustave Eiffel.</p>
            </div>
        </div>

        <div class="legal-card legal-card--responsible">
            <div class="legal-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="legal-card__body">
                <h2>Responsable du site</h2>
                <p>Université Gustave Eiffel<br>17 rue Alfred Nobel, 77420 Champs-sur-Marne</p>
            </div>
        </div>

        <div class="legal-card legal-card--email">
            <div class="legal-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
            </div>
            <div class="legal-card__body">
                <h2>Adresse e-mail</h2>
                <p><a href="mailto:gustave-eiffel@gmail.com">gustave-eiffel@gmail.com</a></p>
            </div>
        </div>

        <div class="legal-card legal-card--hosting">
            <div class="legal-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"/><rect x="2" y="14" width="20" height="8" rx="2" ry="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
            </div>
            <div class="legal-card__body">
                <h2>Hébergement</h2>
                <p>Le site est actuellement hébergé en local avec XAMPP pendant la phase de développement.</p>
            </div>
        </div>

        <div class="legal-card legal-card--ip">
            <div class="legal-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M15 9.354a4 4 0 1 0 0 5.292"/></svg>
            </div>
            <div class="legal-card__body">
                <h2>Propriété intellectuelle</h2>
                <p>Les contenus présents sur ce site sont utilisés uniquement dans un cadre pédagogique.</p>
            </div>
        </div>

        <div class="legal-card legal-card--responsibility">
            <div class="legal-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div class="legal-card__body">
                <h2>Responsabilité</h2>
                <p>Notre site met tout en œuvre pour fournir des informations fiables et à jour, mais ne garantit pas l'exactitude ou l'exhaustivité des offres ou contenus publiés sur la plateforme.</p>
                <p>L'utilisation du site se fait sous la seule responsabilité de l'utilisateur.</p>
            </div>
        </div>

    </section>

    <p class="legal-date">Dernière mise à jour : <?php echo date('d/m/Y'); ?></p>

</main>

<?php
include("includes/footer.php");
?>

