<?php

function send_error($error, $params=null,$code=400) {
    global $i18n;
    http_response_code($code);
    echo json_encode(array('error'=>$i18n->get($error, $args)));
}