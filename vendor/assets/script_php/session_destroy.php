<?php

session_start();

$_SESSION = array();

session_destroy();

header( 'Location: http://www.teammate.dev/?p=home' );