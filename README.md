# Symfony 5 tutorial ze strefy kursów

### 1. Instalacja
```
symfony new strefa-kursow-symfony-5 --full
```

### 3. Pierwsze funkcjonalności

##### Pierwszy kontroler

Tworzę kontroler <b>IndexController</b> przy pomocy komendy
```
php bin/console make:controller
```

##### Przekazywznie zmiennej z kontrolera do widoku
Przykład przekazania zmiennej i listy z IndexControllera do widoku

### 4. Architektura bazy danych

##### Konfiguracja połączenia z bazą danych
1. Tworzę db z poziomu <b>phpmyadmin</b> o nazwie <b>image_host</b>
2. Edytuję zmienną <b>DATABASE_URL</b> w pliku <b>.env</b>
3. Testuję połączenie z bazą wysyłając zapytanie w CLI
```
php bin/console doctrine:query:sql "SHOW DATABASES"
```
Jeśli nie zwróci errora to śmiga :)

