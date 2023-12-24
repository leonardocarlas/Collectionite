# Documentation

- una pull corrisponde all'apertura di una bustina
    - ha un'id (assegnata in automatico)
    - un numero X di carte (settato manualmente)
    - contiene gli X id delle carte aperte (li cerco da cardmarket)
    - corrisponde ad una espansione con id (chiamo carmarket)
    - corrisponde ad un game con un id (li cerco da carmarket)

hint: creare un mongodb e cercare di popolarlo, fare poi delle query per vedere la consistenza del dato

- l'utente cade nella home e vede tutte le espansioni del game selezionato
    - seleziona l'espansione
    - si apre una schermata con tutte le carte dell'espansione contenenti i dati delle pull
    (Pull associata ad una collezione )
    - mostro le inserzioni dell'utente reseller in base ai contratti che stipulo
    - bisogna garantire il flusso degli utenti (dovrei far autenticare gli utenti, prendere i loro dati e salvarli, fare data analisi, o mettere promo solo provenienti dal sito) --> ottengo un contratto per modificare i siti dei reseller
    - meglio se hanno l'ecommerce

- stabilisco un contratto con il reseller
- lui mi pubblica le pull che fa e io metto sul sito un parte dove può usare un codice sconto
- prevedo che lui possa ricevere questi coupon e applicare gli sconti ai clienti che usano il coupon 

NEXT FEATURE
- c'è un pulsante + che consente all'utente aziendale di inserire nel db le pull che ha fatto 
- dashboard per l'utente business ( da verificare se questo utente può loggarsi con cardmarket )
+ lavoro per me per settare le cose