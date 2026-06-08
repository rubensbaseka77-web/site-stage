<?php
session_start();
include("../includes/header-entreprise.php");
?>
<link rel="stylesheet" href="../assets/css/entreprise.css"><link rel="stylesheet" href="/site_stage/assets/css/dashboard.css">

<link rel="stylesheet" href="../assets/css/aide.css"><main class="aide-page">
<style>
.aide-page{
    max-width: 760px;
    margin: 60px auto;
    padding: 0 20px;
}

.page-title{
    margin-bottom: 30px;
}

.page-title h1{
    font-size: 42px;
    margin-bottom: 10px;
}

.page-title p{
    color:#6B7280;
}

.faq-section{
    display:flex;
    flex-direction:column;
    gap:16px;
}

.faq-item{
    background:#fff;
    border:1px solid #E5E7EB;
    border-radius:14px;
    padding:22px 24px;
}

.faq-item h3{
    font-size:18px;
    margin-bottom:10px;
}

.faq-item p{
    font-size:15px;
    color:#4B5563;
    line-height:1.6;
}
</style>
    <section class="page-title">
        <h1>Comment pouvons-nous vous aider ?</h1>
        <p>Retrouvez les réponses aux questions les plus fréquentes.</p>
    </section>

    <section class="faq-section">

        <div class="faq-item">
            <h3>Comment postuler à une offre de stage ?</h3>
            <p>Pour postuler, vous devez créer un compte étudiant, vous connecter,
            puis cliquer sur le bouton "Postuler" depuis la page détail d'une offre.</p>
        </div>

        <div class="faq-item">
            <h3>Comment suivre mes candidatures ?</h3>
            <p>Une fois connecté, vous pouvez accéder à votre espace candidat
            puis consulter la rubrique "Mes candidatures".</p>
        </div>

        <div class="faq-item">
            <h3>Qui publie les offres de stage ?</h3>
            <p>Les offres peuvent être proposées par l'équipe pédagogique ou les enseignants,
            puis rendues visibles aux étudiants sur la plateforme.</p>
        </div>

        <div class="faq-item">
            <h3>Dois-je avoir un compte pour consulter les offres ?</h3>
            <p>Vous pouvez consulter les offres librement, mais vous devez être connecté
            pour pouvoir postuler.</p>
        </div>

        <div class="faq-item">
            <h3>Que faire si j'ai un problème de connexion ?</h3>
            <p>Vous pouvez contacter l'administration via la page Contact.</p>
        </div>

    </section>

</main>


<?php include("../includes/footer-entreprise.php"); 
?>

