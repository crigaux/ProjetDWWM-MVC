<?php
    define('NAME_REGEX', "/^[A-Za-z-' ]+$/");
    define('MAIL_REGEX', "/^[a-zA-Z0-9_.+-]+@[a-zA-Z-]+\.[a-zA-Z-.]+$/");
    define('PWD_REGEX', "/(?=.*[A-Z])(?=.*\d)(?=.*[!@#$&*])[A-Za-z\d!@#$&*]{8,}/");
    define('PHONE_REGEX', "/^[0][1-9]-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$/");
    define('NB_REGEX', "/^[1-4]$/");
    define('DATE_REGEX', "/^". date('Y', time()) ."-?". date('m', time()) ."-?[0-3][0-9]$/");
    define('TIME_REGEX', "/[1-2]/");