<?php
session_start();

if (!isset($_SESSION["etudiant_id"])) {
    header("Location: ../connexion.php");
    exit;
}

include(__DIR__ . '/../includes/header.php');
?>

<link rel="stylesheet" href="/site_stage/assets/css/convention-candidat.css?v=1">

<main class="conv-page">

    <aside class="conv-sidebar">
        <h2>Espace candidat</h2>
        <p>Gérez vos candidatures et votre profil</p>

        <a href="dashboard.php">▣ Tableau de bord</a>
        <a href="profil.php">👤 Mon profil</a>
        <a href="mes-candidatures.php">📝 Mes candidatures</a>
        <a href="soutenance.php">🎓 Soutenance</a>
        <a class="active" href="convention.php">📄 Convention de stage</a>
        <a href="historique.php">🕒 Historique</a>
        <a href="parametres.php">⚙ Paramètres</a>
    </aside>

    <section class="conv-content">

        <h1>Convention de stage</h1>
        <p class="conv-subtitle">Remplissez les informations ci-dessous pour générer la convention de stage.</p>

        <div class="conv-steps">
            <span class="active">1 Information générales</span>
            <span>2 Parties</span>
            <span>3 Conditions du stage</span>
            <span>4 Validation</span>
        </div>

        <form class="conv-form">

            <div class="conv-grid">
                <div>
                    <label>Titre du stage</label>
                    <input type="text" value="Développeur Web">
                </div>

                <div>
                    <label>Référence de l'offre</label>
                    <input type="text" value="OFF-2026-0158">
                </div>

                <div>
                    <label>Date de début prévue</label>
                    <input type="date" value="2026-05-20">
                </div>

                <div>
                    <label>Date de fin prévue</label>
                    <input type="date" value="2026-08-20">
                </div>

                <div>
                    <label>Durée du stage</label>
                    <input type="text" value="3 mois">
                </div>

                <div>
                    <label>Nombre d'heures par semaine</label>
                    <input type="text" value="35h">
                </div>
            </div>

            <h2>Missions principales</h2>
            <p class="small">Décrivez les missions qui seront confiées au stagiaire.</p>

            <textarea rows="6">• Développement de nouvelles fonctionnalités
• Maintenance de l'application existante
• Participation aux réunions d'équipe
• Rédaction du document technique</textarea>

            <h2>Gratification</h2>

            <div class="conv-grid">
                <div>
                    <label>Le stage est-il gratifié ?</label>
                    <div class="radio-line">
                        <label><input type="radio" checked> Oui</label>
                        <label><input type="radio"> Non</label>
                    </div>
                </div>

                <div>
                    <label>Montant mensuel (€)</label>
                    <input type="text" value="600">
                </div>
            </div>

            <label>Avantages optionnels</label>
            <input type="text" placeholder="Ex : Tickets restaurant, transport, prime...">

            <h2>Documents joints</h2>

            <div class="upload-box">
                📄 Glissez vos fichiers ici ou cliquez pour parcourir
            </div>

            <div class="conv-actions">
                <button type="button" class="btn-cancel">Annuler</button>
                <button type="submit" class="btn-next">Suivant →</button>
            </div>

        </form>

    </section>

</main>

<?php include(__DIR__ . '/../includes/footer.php'); ?>