Pseudocodice del master.py

Master.py():

    1. Ogni giorno fa lo scanner di espansioni. Esegue:
        - Expansion/download_xml_exp.java
        - json_creator.py
        - viene prodotto il file insert_exp_new.sql

    2. Esegue il confronto tra  insert_exp_new.sql esegue i confronti con la tabella espansione:

        3. If (ci sono id_expansion nuove in insert_exp_new):

            - esegue il collegamento con il db e inserisce le nuove espansioni
            - (rinomina le insert_exp_new in insert_exp_old)
            - segnala le espansioni al file T\src\TestMain.java
            - viene prodotto il file insert_card.sql
            - master.py esegue il collegamento al db ed inserisce le nuove carte
    
    4. Esegue l'aggiornamento dei prezzi:
        - Priceguide/download_en64_priceguide.java
        - esegue decode_and_extract.py
        - viene prodotto il file update_cards_prices.sql
        - si connette al db e esegue il update_cards_prices.sql
        (definire anche la tabella per wall street)

Ogni 60 secondi scarica i nuovi contenuti delle subreddit
    
