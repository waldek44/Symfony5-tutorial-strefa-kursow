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

##### Utworzenie Encji User
> Encja to zmapowana tabela db na obiekt (Klasa encji to nazwa tabeli, zmienne to nazwy kolumn tabeli)  
> np:  
> Mam tabelę User z polami id, username, password, itp.  
> Wtedy każde pole tabeli to obiekt, więc do username odwołuję się jak do obiektu:  
> aby pobrać - getUsername()  
> aby przypisać wartość - setUsername()

1. Tworzę Encję użytkownika w CLI (jako unique property ustawiam username)
```
php bin/console make:user
```

2. w pliku <b>config/packages/security.yaml</b> komentuję `provider: app_user_provider`  

3. Aby rozszerzyć encję, dodać do istniejącej encji nowe pole wykonuję:
```
php bin/console make:entity
```
Wpisuję nazwę już istniejącej encji User - dzięki temu będę mógł dodać kolejne pola.

##### Utworzenie Encji Photo
1. Dodaję encję o nazwie Photo
```
php bin/console make:entity
```


##### Migracja bazy danych

1. Tworzę plik migracji
```
php bin/console make:migration
```

2. Wysyłam migrację do MySql
```
php bin/console doctrine:migrations:migrate
```