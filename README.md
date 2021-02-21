# Laser hair removal control panel to manage client's treatments in beauty center

Full PHP script control panel to manage client's database and sessions of laser hair removal treatments in a beauty center.

## Features:

- Add, edit, remove clients.
- List all clients or search one client.
- Upload system of client's disclaimer treatment documents.
- Add, remove new treatment to client. (Mode just one session or Pack of 5 sessions ("bonus pack")).
- Consume session of client.
- Counter of sessions left of each treatment of client.
- Option "pay before session treatment" or "pending payment" label reminder).
- Note: script is actually only translated to spanish, sorry.

## Requirements

PHP and MySQL database.

## Instalation

1. Import in MySQL tables struct from database_struct.sql.
2. Configure MySQL connection parameters in connectDB.php.
3. Set in upload.php file full path to /documents/ folder where will be stored client's disclaimer treatment documents.
4. Upload all files to your hosting. Done.

## Screenshots
Main page of control panel:

<img src=screenshots/01.jpg width=600>


Listing clients:

<img src=screenshots/02.jpg width=600>


Add new client to database:

<img src=screenshots/03.jpg width=600>


Client treatments and sessions consumption:

<img src=screenshots/04.jpg width=600>


Add new treatment:

<img src=screenshots/05.jpg width=600>


Sessions consumption page:

<img src=screenshots/06.jpg width=600>


Client's disclaimer treatment documents upload:

<img src=screenshots/07.jpg width=600>

## Collaborations

Collaborations to improve script are always welcome.