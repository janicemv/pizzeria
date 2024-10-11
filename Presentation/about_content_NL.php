<?php
// Presentation/about_content.php

declare(strict_types=1);

$title = "Over";

?>

<!DOCTYPE html>
<html lang="nl">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>

    <div class="container">
        <h1><?= $title ?></h1>

        <p>Dit project, ontwikkeld als een eindopdracht PHP, verkent de creatie van een functioneel online bestelsysteem voor een pizzeria. Geïmplementeerd volgens het MVC-model, integreert het systeem verschillende aspecten van een e-commerce platform, van het bekijken van pizza's tot het verwerken van bestellingen en voorraadbeheer. Bezoekers kunnen de beschikbare pizza's doorbladeren en artikelen aan hun winkelwagentje toevoegen zonder een account te hoeven aanmaken, wat zorgt voor een vereenvoudigde en soepele gebruikerservaring.</p>

        <p>Het doel van het systeem is om een echte online bestelomgeving te simuleren, waar klanten zich kunnen registreren, inloggen en hun bestellingen kunnen volgen. Bovendien bevat het systeem geavanceerde functies zoals het afhandelen van promoties, validatie van afleveradressen en orderbeheer, wat een uitgebreid overzicht biedt van hoe een robuuste en schaalbare PHP-toepassing te ontwikkelen. Dit project demonstreert hoe de beste programmeerpraktijken en een efficiënte database-structuur kunnen worden toegepast om te voldoen aan de behoeften van een klant in de echte wereld.</p>

        <h2 class="p-2">Basisfuncties die in het project zijn geïmplementeerd:</h2>

        <h4>Gebruikersregistratie en Inloggen:</h4>
        <ul class="p-3">
            <li>Gebruikers kunnen een account aanmaken of inloggen met hun e-mail en wachtwoord.</li>
            <li>Optie om als gast bestellingen te plaatsen zonder een account aan te maken.</li>
        </ul class="p-3">

        <h4>Pizza Catalogus:</h4>
        <ul class="p-3">
            <li>Toon alle beschikbare pizza's met namen, prijzen en beschrijvingen.</li>
            <li>Voeg pizza's toe aan het winkelwagentje en bekijk de inhoud van het wagentje op elk moment.</li>
        </ul class="p-3">

        <h4>Winkelwagentje:</h4>
        <ul class="p-3">
            <li>Voeg pizza's toe, verwijder ze of pas de hoeveelheden in het wagentje aan.</li>
            <li>Real-time update van de totale prijs op basis van de inhoud van het wagentje.</li>
        </ul class="p-3">

        <h4>Bestelling Afrekenen:</h4>
        <ul class="p-3">
            <li>Validatie van adressen tijdens het afrekenproces, waardoor bestellingen worden beperkt tot bepaalde postcodes.</li>
            <li>Een samenvattingspagina om de bestelling te bekijken en te bevestigen voordat deze wordt afgerond.</li>
        </ul class="p-3">

        <h4>Bestelbeheer:</h4>
        <ul class="p-3">
            <li>Volg de status van bestellingen (besteld, voorbereid, geleverd).</li>
            <li>Optie voor de admin of gebruiker om de status van de bestelling bij te werken.</li>
        </ul class="p-3">

        <h4>Promoties:</h4>
        <ul class="p-3">
            <li>Toepassen van kortingen en speciale prijzen voor in aanmerking komende klanten.</li>
            <li>Beheer van promotionele prijzen dynamisch tijdens het afrekenen.</li>
        </ul class="p-3">

        <h4>Database-integratie:</h4>
        <ul class="p-3">
            <li>MySQL-database om gebruikersgegevens, bestellingen en pizzainformatie op te slaan en op te halen.</li>
            <li>Gebruik van SQL-query's voor efficiënte gegevensbeheer.</li>
        </ul class="p-3">

        <p>Deze functionaliteiten bieden een volledige online bestelworkflow, van het doorbladeren van producten tot het volgen van de status van geplaatste bestellingen.</p>


        <?php require_once "presentation/components/footer.html"; ?>
    </div>

</body>


</html>