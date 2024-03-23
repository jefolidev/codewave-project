<?php

$discord_url = "https://discord.com/oauth2/authorize?client_id=1217273438939643924&response_type=code&redirect_uri=http%3A%2F%2Flocalhost%2FLojaVirtual%2Ffunctions%2Fprocess-oauth.php&scope=identify+guilds";
header("Location: $discord_url");
exit();

?>