<?php

import('ttGroupHelper');
function handle_req_clients($params,$body,$user) {
    $action = "list";
    if(count($params)>0) {
        $action = $params[0];
    }
    switch($action) {
        case 'list':
            echo json_encode(ttGroupHelper::getActiveClients(true));
            break;
    }
}
