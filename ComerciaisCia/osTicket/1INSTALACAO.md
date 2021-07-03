Descompactar no diretório web

Chamar pelo navegador

Renomear

include/ost-sampleconfig.php

para

include/ost-config.php

Requer usuário e banco, sendo o user dono do banco e com senha

Config file permission:
Change permission of ost-config.php to remove write access as shown below.

    CLI:
    chmod 0644 include/ost-config.php
    Windows PowerShell:
    icacls include\ost-config.php /reset
    FTP:
    Using WS_FTP this would be right hand clicking on the file, selecting chmod, and then remove write access
    Cpanel:
    Click on the file, select change permission, and then remove write access.

Below, you'll find some useful links regarding your installation.
Your osTicket URL:
http://localhost/osTicket/ 	Your Staff Control Panel:
http://localhost/osTicket/scp
osTicket Forums:
https://forum.osticket.com/ 	osTicket Documentation:
https://docs.osticket.com/

PS: Don't just make customers happy, make happy customers!
