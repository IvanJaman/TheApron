# The Apron – Web aplikacija za recepte

The Apron je jednostavna web aplikacija za upravljanje receptima izrađena u **PHP, MySQL, HTML, CSS i JavaScript**.  
Pokreće se lokalno pomoću **XAMPP-a**.

---

## 1. Pokretanje projekta (XAMPP)


Pokreni XAMPP Control Panel i pokreni:
- Apache
- MySQL

---

### 2. Postavljanje projekta

Kopiraj projekt u: 
C:\xampp\htdocs\TheApron

---

### 3. Pokretanje aplikacije

Otvori u pregledniku: http://localhost/TheApron/

---

## Postavljanje baze podataka

### 1. Otvori phpmyadmin sučelje 

Otvori u pregledniku: http://localhost/phpmyadmin/index.php

---

### 2. Kreiranje baze

Kreiraj bazu:
theapron

---

### 3. Import SQL datoteke

U phpMyAdmin:
- otvori tab **Import**
- odaberi datoteku:
sql/theapron.sql

- klikni **Go**

---

## Kreiranje admin korisnika

1. Registriraj običnog korisnika
2. U phpMyAdmin promijeni role u admin
