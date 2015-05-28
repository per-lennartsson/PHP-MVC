Redovisning
====================================

Kmom01: PHP-baserade och MVC-inspirerade ramverk
------------------------------------

Första kursmomentet är nu klart.  

Jag sitter och programmerar på min MacBook Pro 13" och har precis gått över till texteditorn "Atom" från att tidigare kört "Coda 2", är lite omställning att går över från en editor med inbyggt ftp client till en utan, men efter att fått tillägen i atom att fungera med auto upload till serven att fungerar går et hyfsat smidigt. Utöver det så har jag transmit som ftp client för att föra över hela hemsidor.  

Jag har aldrig hållit på med ramverk för så det är helt nytt för mig, nu i början känns det mycket svårare pga mycket fler filer att ha koll på. Men jag ser fördelarna med att där finns mycket färdigt så när allt börjar falla på plats hur det användas ska det nog fungera bra.

Hade inte särskilt mycket kunskap om begreppen innan så det var mycket nytt att ta inte, men känner att jag har lite koll på dem nu iaf, men där är mycket att lära.  

Anax-MVC modellen är rolig, jag börjar få en aning om hur den fungerar. Mycket ha koll på och veta var det ligger och hur man ska göra allt.  

Nu lite om hur det gick med kursmomentet. Det började med att vi var ett gäng på torsdagen som gick igenom hur Anax-MVC fungerar. Det fick mig att se hur det fungerade.
Jag kom igång bra med "Bygg en me-sida med Anax-MVC" och allt flöt på. Största problemen jag stötte på var att veta var koden skulle ligga. Jag har valt att inte ändra i css eller något på utseendet för vill lägga lite mer tid på det i Kmom03 när vi börjar arbeta med LESS.

Kmom02: Kontroller och modeller
------------------------------------

Detta har varit en intressant och lärorikt moment. Det har tigit tid och jag har fastnat många gånger men det är lite roligt och gör att jag blir mer motiverad att lösa det. Det är ett moment jag känner att man har stor nytta av, att lära sig composer och packagist är något man kan ha med sig i framtiden och ha stora fördelar av.

Composer har jag aldrig använd innan, men det känns bra och jag ser potential i att använda det och hur smidigt det kan vara. Att sen kunna hitta paketen på packagist är bra då man kan söka ett det man behöver och se om där än något som passar och bara inkludera det i composer filen. Tittade lite vad det fanns för packet på packagist och där finns mycket intressant som säkert kan vara användbart men inget jag hunnit testa än.

Jag har lite svårt för alla begrepp, det är många ny och lära sig och förstå innebörden av och något jag behöver titta betydlig mer på inna jag känner att det har fastnat.

Där fanns ju svagheter i koden som det ingick i uppgiften att förbättra som t.ex. att det skulle vara olika kommentarer på olika sider, utöver det hittade jag inte några svagheter.

Kmom03: Bygg ett eget tema
------------------------------------

Jag har aldrig jobbat med CSS-ramverk innan men kollat lite på bootstrap när jag skulle gjort någon hemsida men tyckt att det varit för mycket att sätta sig in i för en väldigt basic sida. Men det är något som ska sättas upp på listan för saker att titta mer på när det finns tid.

Tycker less är väldigt bra, tycker det är svårt att få en bra struktur på sidan med ren css kod utan att hårdkoda fast sakerna, så där är less till stor nytta när man kan använda grid layout. Har haft problem med att jag får uppdaterar sidan flera gånger innan jag se en ändring. Ett annan problem jag hade var med behörigheten på filerna när jag satt och jobbade lokalt och laddade upp den på servern så blev rättigheterna fel.

Som jag skrev innan tycker jag det är bra med grid layout, man får en bättre struktur i sidan och lättare att få det responsivt och man använder det tycker jag.

Gillar Font Awesome att där finns så mycket ikoner så slipper man starta illustrator eller photoshop för att skapa standard ikonerna. Tycker det är bra att använda normalizer så slippar man villa problem med att det ser olika ut beroende på vilken webbläsare man använder. Kollade inte så mycket på Bootstrap, men tycker det verkar bra och att det finns många möjligheter med det.

Gjorde inte särskilt mycket med mitt tema, största ändringen är väll att det är ganska många delar som jag valt att ta bort om man besöker sidan från en mobil med liten skärm. För jag tycker själv det är jobbigt om där är för mycket på en sida när man sitter med mobilen där är det bättre att det visas en meny där man kan få fram det som plockats bort.

Kmom04: Databasdrivna modeller
------------------------------------

kursmomentet 4 klart, det har varit ett jobbigt moment som har tagit mycket tid men det har varit väldigt lärorikt. Lärt sig mycket saker som kommer användas i projektet. Ett stort problem jag hade var när en sida skulle " $this->response->redirect($url);" så fick jag felet att en header redan var skickad pga att jag hade debug-läge på där det kördes echo innan vilket gjorde att det krockade.

Jag tycker formulärhantering fungerar bra, lite svårt att förstå först men när jag väl gjort det är den otroligt smidig att använda.
Stora fördelar att att det går betydligt snabbare att bygga upp ett formulär nu och få de inställningarna man vill med det. En sak jag inte tycker om är hur den validerar e-post fältet, där tycker jagfdet hade varit bättra att använda den valideringen som finns i webbläsaren.

Det känns lite ovant den databashanteringen som vi gör nu när man är van vi vanlig sql men föredrar denna typen vi gör nu och tror den kommer vara smidigare att använda när jag väl lärt mig den ordentligt och satt mig in i det. Men tror det kommer vara smidigare att använda denna typen i projektet än vanlig sql kod.

Basklassen och sättet man gjorde det va på va väldigt smidigt, att använda sig av klassnamnet på tex user och implementera basklassen gjorde så det blev väldigt mycket lättare sen när man skulle lägga comments i databasen. Det var mestadels bara att ta kod från UsersController sen och implementera i CommentsController för att få allting att funka. Det gick ganska smidigt, lite småfel och att man glömt ändra saker när man flyttade från user till comment men anors inga stora problem.

Kmom05: Bygg ut ramverket
------------------------------------

Detta kursmoment har gått bra och jag valde att göra en modul för att visa flashmeddelanden. Min modul har fyra inbyggda typer av meddelanden men också stöd för egna typer vilket gör att det är bara skicka in en annan typ och lägga till stylen för den i css filen. Den valda typen blir en klass som sätts på en div som meddelandet skrivs ut i. Dessa klasser stylar jag sedan med en stilmall som också följer med modulen. Jag skrev även en exempel fil på hur man använder modulen.

Jag fick inspiration från Phalcon dokumentation och använde ingen kodbas utan skrev koden själv.

Det gick bra att utveckla själva modulen med hade lite problem med att intrigera den i ramverket, fick inte namespace att fungera till en början men när väl det fungerade var det inga problem.

Jag stötte först på problem när jag skulle publicera paketet på packagist, jag fick inte delen där github och packagist kommunicerar med varandra automatisk att fungerar, men började om från början och följde beskrivningarna noggrant och då fungerade det.

Dokumentation gick ganska bra, svårt att veta vad man ska skriva och hur man sak förklara hur man lägger till det i ramverket men fick ihop en liten beskrivning i alla fall.
Testade modulen genom att klona en helt ny kopia av Anax-MVC och lägga till modulen i composer.json och installerar det på det sättet och det fungerade bra.

Jag gjorde tyvärr inte extra uppgiften.

Kmom06: Verktyg och CI
------------------------------------

Kursmoment 6 klart och det har gått bra stött på lite problem här och var men det hör till kursmomenten.

**Var du bekant med några av dessa tekniker innan du började med kursmomentet?**

Enhetstestning eller unit testing, code coverage, continuous integration, automated tests och code quality, är några helt nya begrepp för mig och inget jag arbetat med förut. Kändes ovant i början att arbeta med men förstod möjligheterna med det efterhand som jag arbetade.

**Hur gick det att göra testfall med PHPUnit?**

Att göra testfall med PHPUnit gick bra genom att följa exemplen och kolla lite på Github hur andra hade gjort. Fick lite problem i början med att den inte hittade rätt sökväg och kunde inte köra klassen, så det tog lite tid innan jag fick rätt på det visade sig att jag hade fel i ett namespace.

**Hur gick det att integrera med Travis?**

Det gick ganska problemfritt att integrera Travis, inga större bekymmer med det lite små problem att få det att sammarbeta med Github bara.

**Hur gick det att integrera med Scrutinizer?**

Det var väll som med Travis lite små problem bara men anors gick det bra.

**Hur känns det att jobba med dessa verktyg, krångligt, bekvämt, tryggt? Kan du tänka dig att fortsätta använda dem?**

Det kändes ovant och lite jobbigt att sätta upp allt första gången men när jag väl började använda det flöt det på bra och ser verkligen nyttan med det. Det är något jag troligt vis kommer fortsätta använda.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**

Jag gjorde tyvärr inte extrauppgiften.



Kmom07/10: Projekt och examination {#kmom10}
------------------------------------


**Webbsidan skall skyddas av inloggning. Det skall gå att skapa en ny användare. Användaren skall ha en profil som kan uppdateras. Användarens bild skall vara en gravatar.**

Jag valde att bara skydda vissa delar av sidan med inloggning, så det går inte att ställa en ny fråga, svara på en fråga, kommentera eller ändra användaren utan att vara inloggad.Jag gjorde även så att det bara går att skapa en ny användare om man inte är inloggad.

Bilden för varje användare är en gravatar och visas på sidan där man ser informationen om användaren.

**Webbplatsen skall ha en förstasida, en sida för frågor, en sida för taggar och en sida för användare. Precis som Stack Overflow har. Dessutom skall det finnas en About-sida med information om webbplatsen och dig själv.**

Alla sidor som ska finnas är med.

**En fråga kan ha en eller flera taggar kopplade till sig. När man listar en tagg kan man se de frågor som har den taggen. Klicka på en tagg för att komma till de frågor som har taggen kopplat till sig.**

Varje enskild fråga kan ha flera taggar kopplade med varandra, löste detta genom att ha en separat tabell för enbart taggar och en tabell som håller koll på vilka taggar som hör till vilken fråga. Detta gör så det går att få fram alla frågor till varje enskild tagg på ett smidigt sätt.

**En fråga kan ha många svar. Varje fråga och svar kan i sin tur ha kommentarer kopplade till sig.**

Denna delen var lite svår att först komma på ett sätt där varje kommentar kan hålla reda på vilket svar/fråga den tillhör. Det löste jag genom att ja en rad för frågans id och en för svarets id, så är det en fråga så får den frågans id där och raden för svarets id är 0 och så tvärtom för svar.

**Alla frågor, svar och kommentarer skrivs i Markdown.**

Frågor, svar och kommentarer skrivs i markdown och körs genom CTextFilter för att sedan passa sidan.

**Förstasidan skall ge en översikt av senaste frågor tillsammans med de mest populära taggarna och de mest aktiva användarna.**

På första sidan hittar man de senaste 5 frågorna, man  hittar även de mest aktiva användarna vilket baseras på vem som skrivit flest frågor/svar/kommentarer. Där finns även de mest populära taggarna vilket baseras på hur många frågor där är kopplat till varje tag.

**Webbplatsen skall finnas på GitHub, tillsammans med en README som beskriver hur man checkar ut och installerar sin egen version.**

(Ej hunnit göra tills redovisningen men ska va gjort samma dag)

**Skriv ett allmänt stycke om hur projektet gick att genomföra. Problem/lösningar/strul/enkelt/svårt/snabbt/lång tid, etc. Var projektet lätt eller svårt? Tog det lång tid? Vad var svårt och vad gick lätt? Var det ett bra och rimligt projekt för denna kursen?**

Detta har varit ett roligt och lärorikt projekt men samtidigt väldigt jobbigt och tidskrävande och jag har känt att jag velat ge upp flera gånger. Har stött på många problem på vägen men lyckats ta mig förbi dom flesta, lite småsaker är där som inte fungerar som de ska men inget större.

En sak jag hade stora problem med och det som inte riktigt fungerar som det ska är sql delen där sakerna ska hämtas från databasen, så där fick jag googla ganska mycket och kollade även hur andra som gjort projektet hade löst den delen. Den är inte perfekt men den fungerar någorlunda.
Sen snara problem jag har haft är med hur jag ska strukturera upp allt men det fick komma efterhand och saker fick skrivas om flera gånger för att fungera med varandra.

Jag tyckte projektet var ganska svårt men passade denna kursen, lite utmaning ska det vara. Men det gäller att man har ganska bra koll på de andra kursmomenten och hur ramverket fungerar för att klarar av det.

**Avsluta med ett sista stycke med dina tankar om kursen och vad du anser om materialet och handledningen (ca 5-10 meningar). Ge feedback till lärarna och förslå eventuella förbättringsförslag till kommande kurstillfällen. Är du nöjd/missnöjd? Kommer du att rekommendera kursen till dina vänner/kollegor? På en skala 1-10, vilket betyg ger du kursen?**

Mina tankar om kursen är att det har varit en intressant och lärorik kurs men även ganska svår och har tagit mycket tid. De träffarna vi har haft på torsdagar har varit guld värda där har man verkligen fått den hjälp med det man behöver och kommit vidare, irc chatten har även varit till stor hjälp när man fastnat.

Men överlag är jag väldigt nöjd med kursen och skulle utan problem kunna rekommendera den. Jag ger kursen en 8:a.
