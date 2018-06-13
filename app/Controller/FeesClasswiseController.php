<?php
class FeesClasswiseController extends AppController
{
    var $name = 'FeesClasswise';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_TotalFeesClasswise','App_TotalPaidFeesClasswise','App_TotalRemainingFeesClasswise');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
   		$this->layout = 'admin_form_layout';
        $this->FeesClasswise->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'FeesClasswise.created ASC'
        );

        $this->set('FeesClasswise', $this->paginate('FeesClasswise')); 
    }
    
    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->Fee->set($this->request->data);

            if ($this->Fee->Validation()) {
                $this->Fee->create();
                if ($this->Fee->save($this->request->data)) {
                   
                    $this->Session->setFlash('FeesClasswise Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('FeesClasswise Not Added Please Try Again!', 'message_bad');
            }
        }

        $classes = $this->Fee->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
		$getPaymentTerms = $this->Fee->PaymentType->getPaymentTerms();
        $this->set('paymentTerms', $getPaymentTerms);
		
		$getFeeTypeList = $this->Fee->FeeType->getFeeTypeList();
        $this->set('getFeeTypeList', $getFeeTypeList);
		
		
		
    }
    
    public function admin_edit($id = null)
    { 
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Fee->id = $id;
        if (empty($this->Fee->id)) {
            $this->Session->setFlash('Invalid Fee !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Fee->Validation()) {
                if ($this->Fee->save($this->request->data)) {

                   $this->Session->setFlash('FeesClasswise Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('FeesClasswise Not Saved Please Try Again!', 'message_bad');
                }
				

            } else {
                $this->Session->setFlash('FeesClasswise Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Fee = $this->Fee->find('first', array(
                'contain' => array(),
                'conditions' => array('FEE_ID' => $id)
            ));
            if(empty($Fee)) {
                $this->Session->setFlash('Invalid Fee !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Fee;
        }

        $classes = $this->Fee->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
		$getPaymentTerms = $this->Fee->PaymentType->getPaymentTerms();
        $this->set('paymentTerms', $getPaymentTerms);
		
		$getFeeTypeList = $this->Fee->FeeType->getFeeTypeList();
        $this->set('getFeeTypeList', $getFeeTypeList);
      
    }

    public function admin_delete($Id = null)
    {
        $FeesClasswise = $this->Fee->find('first', array(
            'contain' => array(),
            'conditions' => array('FEE_ID' => $Id)
        ));

    
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
			$this->Fee->id = $Id;
			if($this->Fee->saveField("STATUS",0)) { 
				$this->Session->setFlash('Fee has been removed successfully.', 'message_good');
				$this->redirect(array('action' => 'index'));
			}
		} else {
            $this->Session->setFlash('Invalid Fee.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
    
    public function App_TotalFeesClasswise()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $ClassId = $this->request->data['CLASS_ID'];

        $FeesClasswise = $this->Fee->find('all', array(
            'conditions' => array('CLASS_ID' => $ClassId, 'Fee.STATUS' => 1),
            'contain' => array('PaymentType','FeeType')
        ));


        if(!empty($FeesClasswise))
        {
            $message = 'Total FeesClasswise';
            $status = true;
        }
        else
        {
            $message = 'No Data Found';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $FeesClasswise
        );

        echo json_encode($result_array); die;

    }
    
    public function App_TotalPaidFeesClasswise()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $UserId = $this->request->data['USER_ID'];

        $this->LedgerXref = ClassRegistry::init('LedgerXref');

        $FeesClasswise = $this->LedgerXref->find('all', array(
            'conditions' => array('USER_ID' => $UserId, 'LedgerXref.STATUS' => 1),
            'contain' => array('PaymentType','FeeType')
        ));

        if(!empty($FeesClasswise))
        {
            $message = 'Total FeesClasswise';
            $status = true;
        }
        else
        {
            $message = 'No Data Found';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $FeesClasswise
        );

        echo json_encode($result_array); die;

    }
    
    public function App_TotalRemainingFeesClasswise()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $ClassId = $this->request->data['CLASS_ID'];
        $UserId = $this->request->data['USER_ID'];

        $FeesClasswise = $this->Fee->find('all', array(
            'conditions' => array('Fee.CLASS_ID' => $ClassId, 'Fee.STATUS' => 1),
            'contain' => array('FeeType'),
        ));

        $this->LedgerXref = ClassRegistry::init('LedgerXref');
        $tmp = array();
          $j = array();
        foreach($FeesClasswise as $key => $val)
        {
            $feeType = $val['Fee']['FEE_TYPE'];
            $feeAmount =  $val['Fee']['FEE'];

            $PaidFeesClasswise = $this->LedgerXref->find('all', array(
                'contain' => array('FeeType'),
                'conditions' => array('LedgerXref.USER_ID' => $UserId,'LedgerXref.FEES_TYPE'=>$feeType, 'LedgerXref.STATUS' => 1)

            ));
            if(isset($PaidFeesClasswise) && sizeof($PaidFeesClasswise))
            {
               foreach($PaidFeesClasswise as $paidkey=>$paidvalue ) {
                       $balance = (int)$val["Fee"]["FEE"] - (int)$paidvalue["LedgerXref"]["AMOUNT"];
                       $j[] = array("AMOUNT"=>"$balance","FEE"=>$paidvalue["FeeType"]["TITLE"],"FEE_TYPE"=>$paidvalue["LedgerXref"]["FEES_TYPE"]);
               }
            }


            if(!$this->in_array_r($j, 'FEE_TYPE', $val["Fee"]["FEE_TYPE"])) {
             
               $j[] = array("AMOUNT"=>$val["Fee"]["FEE"],"FEE"=>$val["FeeType"]["TITLE"],"FEE_TYPE"=>$val["Fee"]["FEE_TYPE"]) ;

            }
        }


        $total = 0;
        foreach($j as $kk=>$t) {
            $total = $total+$t["AMOUNT"];
        }


        if(isset($j) && !empty($j))
        {
            $message = 'Total Remaining FeesClasswise';
            $status = true;
	    $newtmp[] = $j;
            $result_array = array(
                'status' => $status,
                'message' => $message,
                'data' => $j,
                'total' => "$total"
            );
        }
        else
        {
            $message = 'No Data Available';
            $status = false;

            $total = 0;

            $result_array = array(
                'status' => $status,
                'message' => $message,
                'total' => $total
            );
        }
        echo json_encode($result_array); die;

    }
    
    function in_array_r($array, $field, $find){
    foreach($array as $item){
        if($item[$field] == $find) return true;
    }
    return false;
}


}