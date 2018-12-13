<?php

chdir( __DIR__ . '/public');

$host = "localhost";
$port = "8500";

$command = sprintf('%s -S %s:%s', "php", $host, $port);

print_r("Development server started: <http://{$host}:{$port}>\n");
passthru($command, $status);
