<?php

function printInfo()
{
    echo "<h1>DDEV selenium grid</h1>";
    echo "<h2>Access selenium</h2>";
    echo "<p>Use <strong>ddev-selenium-hub</strong> as host for selenium inside other ddev containers</p>";

    echo "<h2>Access browsers</h2>";
    $url = getenv("DDEV_PRIMARY_URL");
    $url_chrome  = str_replace('https', 'http', $url) . ':7900';
    $url_firefox  = str_replace('https', 'http', $url) . ':7901';
    echo("<ul>");
    echo('<li><strong>Chrome</strong> web vnc: <a href="' . $url_chrome . '">' . $url_chrome . '</a></li>');
    echo('<li><strong>Firefox</strong> web vnc: <a href="' . $url_firefox . '">' . $url_firefox . '</a></li>');
    echo("</ul>");
}

printInfo();
