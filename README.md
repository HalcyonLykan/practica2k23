## Practică Roweb 2023

Instrumente necesare: 

 - [XAMPP](https://www.apachefriends.org/download.html)
 - [Composer](https://getcomposer.org/download/)
 - [VSCode](https://code.visualstudio.com/)

Tehnologii folosite:

- [Laravel 10.x](https://laravel.com/docs/10.x)
- [Bootstrap 5](https://getbootstrap.com/docs/5.3/getting-started/introduction/)

Instrucțiuni setup:

 1. Descărcați ca zip si dezarhivați în folderul [Calea de instalare a XAMPP]/htdocs 
 2. În folderul in care ați dezarhivat proiectul: creați un fișier ".env" și copiați conținutul fișierului ".env.example" înauntrul său.
 3. Deschideți panoul de administrare XAMPP și porniți "Apache" și "MySql"
 4. Deschideti un terminal în folderul în care l-ați dezarhivat și rulați `composer install`. În funcție de sistemul de operare:
	- Pentru Windows 11 și majoritatea distribuțiilor de Linux: Click Dreapta -> Open in terminal
	- Pentru Windows 10 sau mai vechi: tasta cu logo de windows + R (apăsate în același timp, fără shift) -> `powershell` (în cazul in care PowerShell nu e disponibil: `cmd`)
 5. În același terminal rulați `php artisan key:generate`
 6. Opțional, în același terminal rulați `npm install` (pasul acesta ncesita [NodeJS](https://nodejs.org/en))
 7. Dacă e necesar, modificați în fișierul ".env" cheile `APP_URL`, `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
 8. În același terminal folosit mai sus, rulați `php artisan migrate:fresh --seed`

Aplicația ar trebui sa fie acum disponibila în browser la adresa [http://localhost](http://localhost).

Fișierele discutate la practică vor conține comentarii. Comentariile sunt scrise o singură dată, dar secțiunile de cod la care se referă se pot repeta.

## English

Necessary Tools: 

 - [XAMPP](https://www.apachefriends.org/download.html)
 - [Composer](https://getcomposer.org/download/)
 - [VSCode](https://code.visualstudio.com/)

Technology Stack:

- [Laravel 10.x](https://laravel.com/docs/10.x)
- [Bootstrap 5](https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- [Bootstrap Icons](https://icons.getbootstrap.com/)

Setup Instructions:

 1. Download as ".zip" and extract in [XAMPP installation path]/htdocs 
 2. In the folder where you extracted the project: create a ".env" file and copy the contents of ".env.example" inside it.
 3. Open the XAMPP administration pannel and start "Apache" and "MySql".
 4. Open a terminal in the project's folder and run `composer install`. Depending on your OS:
	- For Windows 11 and most Linux distros: Right Click -> Open in terminal
	- For Windows 10 and older: Windwos Key + R (pressed at the same time, no shift) -> `powershell` (if PowerShell isn't available `cmd`)
 5. In the same terminal run `php artisan key:generate`
 6. Optionally, in the same terminal run `npm install` (this requires [NodeJS](https://nodejs.org/en))
 7. If necessary, modify in your ".env" file, the keys `APP_URL`, `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
 8. In the same terminal as above run `php artisan migrate:fresh --seed`

The app should now be available in your browser at [http://localhost](http://localhost).

Files related to the course will have comments in them. Comments will only be written once even if the code sections to wich they refer are reused.