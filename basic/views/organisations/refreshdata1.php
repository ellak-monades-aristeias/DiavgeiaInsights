<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
//require_once('@vendor/opendata/opendata.php');
require_once(__DIR__ . '/../../vendor/opendata/opendata.php');

$this->title = 'Σχετικά';
$this->params['breadcrumbs'][] = $this->title;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $client = new OpendataClient();
      $response = $client->getResource('/organizations/');
      if ($response->code === 200) {    
          $orgData = $response->data;
          $counter = 1;
          $uid = null;
          $label = null;
          $abbreviation = null;
          $latinName = null;
          $category = null;
          $organizationDomains = null;
          $status = null;
          $supervisorId = null;
          $supervisorLabel = null;
          $website = null;
          $odeManagerEmail = null;
          $vatNumber = null;
          $fekNumber = null;
          $fekIssue = null;
          
          $truncSql = 'TRUNCATE `diavgeiainsights`.`organisations`';
          Yii::$app->db->createCommand($truncSql)->execute();
         
          foreach ($orgData['organizations'] as $org) {
                        print_r($org);
                        $uid = $org['uid'];
                        $label = $org['label'];
                        $abbreviation = $org['abbreviation'];
                        if ($abbreviation == null) {
                              $abbreviation = ''; 
                        }
                        $latinName = $org['latinName'];
                        if ($latinName == null) {
                              $latinName = ''; 
                        }
                        $category = $org['category'];
                        $organizationDomains = $org['organizationDomains'];
                        $status = $org['status'][0];
                        $supervisorId = $org['supervisorId'];
                        $supervisorLabel = $org['supervisorLabel'];
                        $website = $org['website'];
                        $odeManagerEmail = $org['odeManagerEmail'];
                        $vatNumber = $org['vatNumber'];
                        $fekNumber = $org['fekNumber'];
                        $fekIssue = $org['fekIssue'];
                      //print $counter . ") ". $org['uid'] . ": " . $org['label'] . ": ". $org['abbreviation'] . ": ". $org['latinName'] . ": " . $org['category'] . ": ". $org['status'] . ": " . $org['supervisorId'] . ": " . $org['supervisorLabel'] . ": ". $org['website'] . ": " . $org['odeManagerEmail'] . ": " . $org['vatNumber'] . ": ". $org['fekNumber'] . "<br> \n";
                      Yii::$app->db->createCommand()->insert('organisations', array(
                          'uid' => $org['uid'],
                          'label' => $org['label'],
                          'abbreviation' => $org['abbreviation'],
                          'latinName' => $org['latinName'],
                          'category' => $org['category'],
                          'organizationDomains' => '',
                          'status' => '',
                          'supervisorId' => $org['supervisorId'],
                          'supervisorLabel' => $org['supervisorLabel'],
                          'website' => $org['website'],
                          'odeManagerEmail' => $org['odeManagerEmail'],
                          'vatNumber' => $org['vatNumber'],
                          'fekNumber' => $org['fekNumber'],
                          'fekIssue' => $org['fekIssue'],
                      ))->execute();
                      $counter++;
          }

       /*   
          print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Υπογράφοντες:<br>\n";
          foreach ($orgData['signers'] as $signer) {
              print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". $signer['uid'] . ": " . $signer['lastName'] . " " . $signer['firstName'] . "<br>\n";
          }
        */  
      } else {
          echo "Error " . $response->code;
      }
?>