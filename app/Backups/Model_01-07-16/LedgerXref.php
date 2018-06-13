<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LedgerXref extends AppModel
{
    var $name = 'LedgerXref';
    public $useTable = 'ledger_xref';
    public $primaryKey = 'LEDGER_ID';
    
     public $belongsTo = array(
         'PaymentType' => array(
             'className' => 'PaymentType',
             'foreignKey' => 'PAYMENT_TERM',
             'fields' => array('TYPE_ID', 'TITLE'),
         ),

         'FeeType' => array(
             'className' => 'FeeType',
             'foreignKey' => 'FEES_TYPE',
             'fields' => array('FT_ID', 'TITLE'),
         ),
         
         'User' => array(
             'className' => 'User',
             'foreignKey' => 'USER_ID',
             //'fields' => array('FIRST_NAME', 'LAST_NAME', 'DEVICE_ID','CLASS_ID'),
         ),
    );



}