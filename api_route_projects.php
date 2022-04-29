<?php
import('ttConfigHelper');

function handle_req_projects($params,$body,$user) {
    
    $action = "list";
    if(count($params)>0) {
        $action = $params[0];
    }
    
    switch($action) {
        case 'list':
            echo json_encode(list_projects($user));
            break;
    }
}

function list_projects($user) {
    $config = new ttConfigHelper($user->getConfig());

    if ($user->can('track_time')) {
        $rank = $user->getMaxRankForGroup($group_id);
        if ($user->can('track_own_time'))
          $options = array('status'=>ACTIVE,'max_rank'=>$rank,'include_self'=>true,'self_first'=>true);
        else
          $options = array('status'=>ACTIVE,'max_rank'=>$rank);
        $user_list = $user->getUsers($options);
      }
      $options['include_templates'] = $user->isPluginEnabled('tp') && $config->getDefinedValue('bind_templates_with_projects');
      return $user->getAssignedProjects($options);
}