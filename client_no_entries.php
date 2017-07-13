<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('initialize.php');


// Access check.
if (!ttAccessCheck(right_manage_team) || !$user->isPluginEnabled('cl')) {
  header('Location: access_denied.php');
  exit();
}

if (is_numeric($request->getParameter('month')) && is_numeric($request->getParameter('year'))){
    $month = $request->getParameter('month');
    $year = $request->getParameter('year');
} else {
    $month = "06";
    $year = "2017";
}


$mdb2 = getConnection();



$sql = 'SELECT id, name, number from tt_clients WHERE status = 1 and team_id = ' . $user->team_id . ' and id NOT IN(SELECT c.id FROM tt_clients c LEFT JOIN tt_log l ON (c.id = l.client_id) WHERE l.status = 1 and DATE_FORMAT(l.date, "%m-%Y") = "' . $month .  '-' . $year .'")  
ORDER BY UPPER(`tt_clients`.`name`) ASC';

$res = $mdb2->query($sql);

if (!is_a($res, 'PEAR_Error')) {
  while ($val = $res->fetchRow()) {
    $results[] = array('name'=>$val['name'],'id'=>$val['id'],'number'=>$val['number']); // name  - project name, time - total for project in seconds.
    }
}

?>

<style>
    table tr:nth-child(2n) {
        background-color: #DDD;
    }
    
</style>
<html>
    <body>
        <h1>01.<?= $month ?>.<?= $year ?>-30/31.<?= $month ?>.<?= $year ?></h1>
        <form method="GET">
            <input type="text" name="month" value="<?= $month ?>" style="width: 2em;">
            <input type="text" name="year" value="<?= $year ?>" style="width: 4em;">
            <button type="submit">Senden</button>
        </form>
        Keine Eintr&auml;ge f&uuml;r <?= count($results); ?> Kunden.
        <table cellspacing="1" cellpadding="3">
            <tr>
                <td>Nummer</td>
                <td>Name</td>
            </tr>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?= $result["number"] ?></td>
                <td><?= $result["name"] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>


