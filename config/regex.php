<?php
    define('NAME_REGEX', "/^[A-Za-z-' ]+$/");
    define('MAIL_REGEX', "/^[a-zA-Z0-9_.+-]+@[a-zA-Z-]+\.[a-zA-Z-.]+$/");
    define('PWD_REGEX', "/(?=.*[A-Z])(?=.*\d)(?=.*[!@#$&*,;:?./§ù%*µ^¨£€])[A-Za-z\d!@#$&*,;:?./§ù%*µ^¨£€]{8,}/");
    define('PHONE_REGEX', "/^[0][1-9]-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}-?[0-9]{2}$/");
    define('NB_REGEX', "/^[1-8]$/");
    define('DATE_REGEX', "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/");
    define('TIME_REGEX', "/[1-2]/");