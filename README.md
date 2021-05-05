
## Requirements
-- XAMPP  
Es wird mindestens der Apache-webserver und der MYSQL-Server benötigt.  
https://www.apachefriends.org/de/index.html  

## Setup
Nachdem XAMPP installiert wurde, das Repo in den XAMPP eigenen htdocs Ordner klonen.  
Danach kann man über das XAMPP control-panel den Webserver und den Datenbankenserver starten.  

Die API sollte jetzt über http://localhost/library/{route] erreichbar sein.  
### Datenbank
Jetzt fehlt nurnoch die Datenbank!  
Über http://localhost/phpmyadmin kann man die Datenbank bearbeiten.  
Zunächst muss deine neue Datenbank erstellt werden.  
Sie muss den Namen "db_library" tragen.  
Über db_library kann man dann library.sql (im gitrepo enthalten) importieren.  
