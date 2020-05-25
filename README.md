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

### 5. Budowanie widoku strony głównej
1. Pobieram bootstrap i jquery  
2. W katalogu public tworzę katalog assets, w nim katalogi css, images i js - wrzucam do nich bootstrap i jquery  
3. W <b>base.html.twig</b> dodaję linki do styli za pomocą funkcji asset()
4. Linki do stron dodaję funkcją path()

##### Nawigacja witryny
Dodaję nawigację w <b>base.html.twig</b>  

Zapis który pozwala mi stylować aktywny link, korzysta ze zmiennej globalnej app:
```
{% if app.request.get('_route') == 'index' %}active{% endif %}
```
> if obecny route == index to dodaj klasę active do stylu

### 6. Autoryzacja użytkownika

##### Dodanie formularza logowania
Automatyczne generowanie kodu odpowiedzialnego za autoryzację użytkownika dzięki SecurityBundle:
```
php bin/console make:auth
```

##### Data Fixtures
> Data Fixtures to skrypty które ładują zaprogramowane dane aby przekazały się do bazy danych po wywołaniu komendy

1. Najpierw doinstalowuję pakiet orm-fixtures
```
composer require orm-fixtures --dev
```

2. Tworzę fixtures o nazwie UserFixtures (tworzy się też z automatu AppFixtures - mogę go usunąć)
```
php bin/console make:fixtures
``` 

3. Po zmodyfikowaniu fixtures uploaduję je do db:
```
doctrine:fixtures:load
``` 

4. zmieniam przekierowanie po udanym logowaniu w <b>security/LoginFormAuthenticator.php</b>
