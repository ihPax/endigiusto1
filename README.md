# Esame Lorenzo Pavan

# Installazione 
1. Clonare la repository


# Installazione Client
1. Entrare nella cartella `/client` e installare tutte le dipendenze:

npm install


2. Serve

npn run serve


# Collegamento DB

Nella cartella `/server` cercare il file `.env.example`
Creare file `.env` uguale al file `.env.example`, e modificare il nome del database *DB_DATABASE = nome_db*

# Installazione Server

1. Entrare nella cartella `/server` e installare tutte le dipendenze:

composer update


2. Migrazioni (creazione delle tabelle e struttura del database):

php artisan migrate


3. Serve

php artisan serve
