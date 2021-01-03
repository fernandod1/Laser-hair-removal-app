# Laser hair removal app to manage client's threataments in beauty center

Full PHP script control panel to manage client's database and sessions of laser hair removal threataments in a beauty center.

## Features:

- Add, edit, remove clients.
- List all clients or search one client.
- Upload system of client's disclaimer threatament documents.
- Add, remove new threatament to client. (Mode just one session or Pack of 5 sessions ("bonus pack")).
- Consume session of client.
- Counter of sessions left of each threatament of client.
- Option "pay before session threatament" or "pending payment" label reminder).
- Note: script is actually only translated to spanish, sorry.

## Requirements

PHP and MySQL database.

## Instalation

1.) Import in MySQL tables struct from database_struct.sql.
2.) Configure MySQL connection parameters in connectDB.php.
3.) Set in upload.php file full path to /documents/ folder where will be stored client's disclaimer threatament documents.
4.) Upload all files to your hosting. Done.

## Screenshots
Main page of control panel:
<img src=screenshots/01.jpg width=500>

Listing clients:
<img src=screenshots/02.jpg width=500>

Add new client to database:
<img src=screenshots/03.jpg width=500>

Client threataments and sessions consumption:
<img src=screenshots/04.jpg width=500>

Add new threatament:
<img src=screenshots/05.jpg width=500>

Sessions consumption page:
<img src=screenshots/06.jpg width=500>

Client's disclaimer threatament documents upload:
<img src=screenshots/07.jpg width=500>

## Collaborations

Collaborations to improve script are always welcome.