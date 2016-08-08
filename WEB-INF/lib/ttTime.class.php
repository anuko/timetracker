<?php
// +----------------------------------------------------------------------+
// | Anuko Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) Anuko International Ltd. (https://www.anuko.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors:
// | https://www.anuko.com/time_tracker/credits.htm
// +----------------------------------------------------------------------+

import('ttUser');
import('html.HttpRequest');
import('DateAndTime');
import('ttTaskHelper');

class ttTime {
	
    public $id = null;              // record id
	public $start = null;           // start time
	public $finish = null;          // finish time
	public $duration = null;        // duration
    public $date = null;            // date for this log entry
	public $note = null;            // note
	public $custom_field = null;    // custom field value
	public $billable = 1;           // billable
	public $on_behalf_id = null;    // If manager is editing log on behalf of a user
	public $client = null;          // client id
	public $project = null;         // project id
	public $task = null;            // task id	
    public $custom_fields = null;   // custom fields

	private $user = null;           // user data
	
	function __construct($user){
		$num_args = func_num_args();
		if ($num_args < 1) {
			throw new Exception('Time constructor needs user object as first parameter!');
		}
		
		if (!is_a($user, "ttUser")){
			throw new Exception("First argument should be type of ttUser!");
		}
		else {
			$this->user = $user;
		}

		if ($num_args > 1){
            $data = func_get_arg(1);
            
            if ($user->isPluginEnabled('cf')){
                require_once(PLUGINS_DIR.'/CustomFields.class.php');
                $this->custom_fields = new CustomFields($user->team_id);
            }

            if (is_a($data, "ttHttpRequest")) {
                $this->start = trim($data->getParameter('start'));
                $this->finish = trim($data->getParameter('finish'));
                $this->duration = trim($data->getParameter('duration'));

                $this->date = $this->parseDate($data->getParameter('date', @$_SESSION['date']));
                $this->note = trim($data->getParameter('note'));
                $this->custom_field = trim($data->getParameter('cf_1', ($data->isPost() ? null : @$_SESSION['cf_1'])));

                if ($user->isPluginEnabled('iv')){
                    $cl_billable = $data->getParameter('billable', $_SESSION['billable']);
                }
                
                $this->on_behalf_id = $data->getParameter('onBehalfUser', (isset($_SESSION['behalf_id'])? $_SESSION['behalf_id'] : $user->id));
                $this->client = $data->getParameter('client', ($data->isPost() ? null : @$_SESSION['client']));
                $this->project = $data->getParameter('project', ($data->isPost() ? null : @$_SESSION['project']));
                $this->task = $data->getParameter('task', ($data->isPost() ? null : @$_SESSION['task']));

                // a current record exists
                if ($num_args == 3){
                    $current_record = func_get_arg(2);
                    if (is_array($current_record)){
                        $this->id = $current_record['id'];
                        $this->current_date = $this->parseDate($current_record['date']);
                    }
                }
            } elseif (is_array($data)) {
                $this->id = $data['id'];
                $this->start = $data['start'];
                $this->finish = $data['finish'];
                $this->duration =$data['duration'];

                $this->date = $this->parseDate($data['date']);

                $this->note = $data['comment'];

                  // If we have custom fields - obtain values for them.
                if ($this->custom_fields) {
                    $fields = $this->custom_fields->get($this->id);
                    if ($this->custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT){
                        $this->custom_field = $fields[0]['value'];
                    } elseif ($this->custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN){
                        $this->custom_field = $fields[0]['option_id'];
                    }
                }
                $this->billable = $data['billable'];
                $this->client = $data['client_id'];
                $this->project = $data['project_id'];
                $this->task = $data['task_id'];
            }
        }
	}

    public function validate($err) {
        $user = $this->user;
        global $i18n;
        // Validate user input.
        if ($user->isPluginEnabled('cl') && $user->isPluginEnabled('cm') && $this->client){
            $err->add($i18n->getKey('error.client'));
        }

        if ($this->custom_fields){
            if (!ttValidString($this->custom_field, !$this->custom_fields->fields[0]['required'])){
                $err->add($i18n->getKey('error.field'), $this->custom_fields->fields[0]['label']);
            }
        }

        if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode){
            if (!$this->project){
                $err->add($i18n->getKey('error.project'));
            }
        }

        if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode && !$this->task) {
            $err->add($i18n->getKey('error.task'));
        }

        // check if user can enter empty value for duration
        $task = ttTaskHelper::getTask($this->task);
        $allow_zero_duration = $task && $task['allow_zero_duration'];

        if (!$this->duration){
            if ('0' == $this->duration) {
                if (!$allow_zero_duration) {
                    $err->add($i18n->getKey('error.field'), $i18n->getKey('label.duration'));
                }
            } elseif ($this->start || $this->finish) {
                if(!ttTimeHelper::isValidTime($this->start)){
                    $err->add($i18n->getKey('error.field'), $i18n->getKey('label.start'));
                } 
                if ($this->finish) {
                    if (!ttTimeHelper::isValidTime($this->finish)) {
                        $err->add($i18n->getKey('error.field'), $i18n->getKey('label.finish'));
                    }
                    if (!ttTimeHelper::isValidInterval($this->start, $this->finish)) {
                        $err->add($i18n->getKey('error.interval'), $i18n->getKey('label.finish'), $i18n->getKey('label.start'));
                    }
                }
            } else {
                if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)){
                    $err->add($i18n->getKey('error.empty'), $i18n->getKey('label.start'));
                    $err->add($i18n->getKey('error.empty'), $i18n->getKey('label.finish'));
                }
                if ((TYPE_DURATION == $user->record_type) || (TYPE_ALL == $user->record_type)){
                    $err->add($i18n->getKey('error.empty'), $i18n->getKey('label.duration'));
                }
            }
        } else {
            if (!ttTimeHelper::isValidDuration($this->duration)) {
                $err->add($i18n->getKey('error.field'), $i18n->getKey('label.duration'));
            }
        }

        if (!ttValidDate($this->date->toString(DB_DATEFORMAT))){
            $err->add($i18n->getKey('error.field'), $i18n->getKey('label.date'));
        }

        if (!ttValidString($this->note)){
            $err->add($i18n->getKey('error.field'), $i18n->getKey('label.note'));
        }
        // Finished validating user input.

        // Prohibit creating entries in future.
        if (defined('FUTURE_ENTRIES') && !isTrue(FUTURE_ENTRIES)){
            $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
            if ($this->date->after($browser_today)){
                $err->add($i18n->getKey('error.future_date'));
            }
        }

        if ($err->no()) {
            // We need to:
            // 1) Prohibit saving locked time entries in any form.
            // 2) Prohibit saving completed unlocked entries into locked interval.
            // 3) Prohibit saving uncompleted unlocked entries when another uncompleted entry exists.
            // 4) Prohibit creating an overlapping record.

            // 1) Prohibit saving locked entries in any form.
            if ($this->id && $user->isDateLocked($this->current_date)){
                $err->add($i18n->getKey('error.range_locked'));
            }

            // 2) Prohibit saving completed unlocked entries into locked range.
            if ($err->no() && $user->isDateLocked($this->date)){
                $err->add($i18n->getKey('error.range_locked'));
            }

            if (($this->finish == '' && $this->duration == '') && ($not_completed_rec = ttTimeHelper::getUncompleted($user->getActiveUser()))){
                if ($not_completed_rec['id'] <> $this->id){
                    // We have another not completed record.
                    $err->add($i18n->getKey('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->getKey('error.goto_uncompleted')."</a>");
                } 
                // elseif (!$not_completed_rec){
                //     // this is a new record
                //     $err->add($i18n->getKey('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->getKey('error.goto_uncompleted')."</a>");
                // }
            }

            if ($err->no() && ttTimeHelper::overlaps($user->getActiveUser(), $this->date->toString(DB_DATEFORMAT), $this->start, $this->finish, $this->id)){
                $err->add($i18n->getKey('error.overlap'));
            }
        }

        return $err;
    }

    private function parseDate($date){
        $parse_try = new DateAndTime(DB_DATEFORMAT, $date);
        if ($parse_try->isError()){
            $parse_try = new DateAndTime($user->date_format, $date);

            if ($parse_try->isError()){
                $parse_try = new DateAndTime(DB_DATEFORMAT);
            }
        }
        return $parse_try;
    }
}
