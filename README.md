# ACCOUNTING SYSTEM FOR SMALL LANGUAGE SCHOOL
Accounting system for small language school - USER INTERFACE IN POLISH LANGUAGE

INSTALLATIOM:
1. Create database acc. to scheme from sqlCreateTable/bazaDanych.sql
2. Fill api/access_comp.php file and add database address, database name, database user login and database user password
3. In file resposnible for printing invoices drukuj_rach.php look for "<div class = "sprzedawca">" and hardcode the language school Name in "Nazwa Firmy", VAT number in "NIP:", registration no. in "REGON:", name of bank for company account "BANK:", company account no. in "KONTO:"
4. In directory assets/img/ you can replace files responsible for favicon, top banner, company stamp and responsible person signatur (for invoice).
5. On the beggining of each year you need to add one row to mySQL table "kwota_wolna" to indicate tax-free allowance for given year.

In case of any errors at first run, please add at least one row to each template - solution was not intended to work with empty tables.
It is strongly recommended to use the tool in internal network only - the tool was not secured from intentional hacking the solution.