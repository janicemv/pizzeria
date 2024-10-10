# WERKWIJZE

De proef bestaat uit twee delen. 
 
[X] In het eerste deel bepaal je de databankstructuur en maak je een ruwe schets van de gebruikersinterface. 

_Bespreek daarna je resultaten met de permanentie-instructeur._
 
[X] In het tweede deel vertrek je van deze databankstructuur en implementeer je deze in MySQL. 

[X] Ontwikkel de applicatie volgens een MVC-model. 
**[X]Vergeet niet om, waar nodig, een correcte foutafhandeling te implementeren.**
[X] Hoewel enigszins ondergeschikt probeer je ook de lay-out van de webpagina’s te verzorgen. 
 
Je krijgt voor het totale project vijf dagen tijd. 

[X] Het is belangrijk dat het resultaat werkt, de achterliggende architectuur volgens de regels van de kunst is opgebouwd en een gestuurd wordt door een gebruiksvriendelijke interface. 

# DE CASE 
De uitbater van een pizzeria wensen hun diensten uit te breiden met de mogelijkheid om online pizza’s te bestellen en thuis te laten leveren. Om de klanten die ter plaatse de maaltijd nuttigen niet te storen is het afhalen van pizza’s niet mogelijk.

## Overzicht en bestelling 
 
[X] Niet-geregistreerde bezoekers kunnen het hele aanbod aan pizza’s bekijken. 
[X] Ze vinden er naast de productinformatie ook de prijs terug. 
[X] Men kan pizza’s toevoegen aan een virtueel winkelmandje, en te allen tijde pizza’s uit dit mandje verwijderen. 
[X] Ter bevordering van de gebruikersvriendelijkheid dient de inhoud van het winkelmandje steeds zichtbaar te zijn, wanneer men het aanbod aan pizza’s bekijken. 
[X] Wanneer men tevreden is met de inhoud van het mandje is er een knop “Afrekenen” ter beschikking. 
- Had de bezoeker zich reeds aangemeld met een bestaande account, dan wordt deze onmiddellijk doorgestuurd naar een pagina waarin een overzicht van de bestelling getoond wordt (zie sectie “Afrekenen”). 

[X] Wanneer de bezoeker niet aangemeld is, wordt eerst een pagina met twee opties getoond: 
 
•  Ik heb een account 
•  Ik heb geen account 
 
[X] Bij de optie “Ik heb een account” wordt een invoervak voor het e-mailadres en wachtwoord voorzien. Vult men de correcte gegevens voor een bestaande account in, dan meldt de bezoeker zich automatisch aan, en wordt hij/zij doorgestuurd naar een pagina waarin een overzicht van de bestelling getoond wordt (zie sectie “Afrekenen”). 
 
[X] Bij de optie “Ik heb geen account” wordt gevraagd volgende gegevens ter plaatse in te vullen: naam- en voornaam, adres, postcode, gemeente en telefoonnummer. 
[X] Er is tevens een selectievakje ter beschikking dat de bezoeker kan aanvinken om in één moeite door a.d.h.v. deze gegevens een nieuwe account aan te maken (in dat 
laatste geval wordt ook een e-mailadres en  wachtwoord gevraagd). 
[X] Daarna wordt er automatisch verder doorgestuurd naar de pagina “Afrekenen”.

## Afrekenen 
 
[X] Uiteindelijk krijgt de bezoeker een overzichtspagina te zien met alle gegevens van de bestelling, alsook de totaalprijs van de bestelling. 
[X] Let er op dat thuisbezorging niet in alle gemeenten mogelijk is. De bezoeker krijgt een foutmelding wanneer hij een postcode invult waar niet geleverd kan worden. 
[X] Er zijn op de afrekeningpagina nog links voorzien die de bezoeker kan volgen om last-minute zijn/haar adresgegevens of de inhoud van het winkelmandje bij te werken. 
   
## Andere voorzieningen en varia 

### Producten 
 
[X] Voor producten zijn de naam en prijs het belangrijkst. 
~~[] Daarnaast kunnen eventueel ook samenstelling/voedingswaarden, beschikbaarheid (seizoensafhankelijke producten) enz.. troeven zijn voor een goede site (facultatief)~~
[X] Er kan tevens een promotieprijs ingesteld worden, die actief wordt wanneer een klant hiervoor in aanmerking komt (zie sectie “Klanten”). 
 
### Klanten 
 
[X] Per klant worden naam, voornaam, straat, huisnummer, postcode, woonplaats, telefoon of gsm, e-mailadres, wachtwoord **(geëncrypteerd met MD5)** en eventuele speciale bemerkingen bewaard. Het is ook mogelijk om voor een bepaalde klant te bepalen of deze in aanmerking komt voor promotieprijzen. 
[X] Zorg ervoor dat het e-mailadres van de laatste correcte aanmelding steeds in een cookie onthouden wordt, zodat de klant niet steeds opnieuw zijn/haar e-mailadres moet invullen om aan te melden. Merk op dat het wachtwoord wel steeds opnieuw ingegeven dient te worden.

### Algemene informatie – Wie zijn wij (optioneel) 
 
_[] Informatie i.v.m. de zaak, lopende promoties, voorwaarden, gastenboek etc_
 
### Bestelinformatie 
 
[X] Uiteraard wordt hier het klantnummer, datum en tijdstip van de bestelling bijgehouden, alsook aantallen, soorten, extra’s, kostprijs en eventuele informatie voor de pizzakoerier. 
 
 
