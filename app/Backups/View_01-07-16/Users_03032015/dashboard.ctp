<div id="maincontent" class="leftcontent">
<div class="page-content-wrapper">
    <div class="page-content">
        <?php echo $this->Session->flash(); ?>
        <?php // echo $this->Session->flash('auth'); ?>

    </div>
	<div class="accountinfo">
		<div class="leftcontent leftmenu">
			<ul>
				<li>History</li>
                <li><a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'apply_new')); ?>" class="side_bar_link">Apply New</a></li>
                <li>Contact Us</li>
			</ul>
		</div>
		<div class="rightcontent rightdesc scroll_data">
		<div class="hist">Service History</div>
		<table border="1" class="historydetailtable restable">
    <thead>
      <tr>
        <th>File ID</th>
        <th>Date</th>
        <th>Email ID</th>
        <th>Name</th>
        <th>Mobile No.</th>
        <th>Status</th>
        <th>Payment</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
    <?php if(isset($result) && !empty($result)) { ?>
    <?php foreach($result as $applicant) { ?>
      <tr>
        <td><?php echo $applicant['Applicant']['app_id']; ?></td>
        <td><?php echo date('d-m-Y', strtotime($applicant['Applicant']['created'])); ?></td>
        <td><?php echo $applicant['Applicant']['email']; ?></td>
        <td><?php echo $applicant['Applicant']['first_name']. ' '.$applicant['Applicant']['last_name']; ?></td>
        <td><?php echo $applicant['Applicant']['mobile_no']; ?></td>
        <td><?php echo $applicant['Applicant']['status']; ?></td>
        <td class="payment_button">
            <?php if($applicant['Applicant']['payment_status'] != 'Completed') { ?>
            <?php
                $subs_text = array();
                $i = 1;
            if(isset($applicant['ApplicationToSubscription'])) {
                foreach($applicant['ApplicationToSubscription'] as $key=>$subs) {
                    $subs_text[$i]['item_name'] = $subs['Subscription']['title'];
                    $subs_text[$i]['amount'] = $subs['Subscription']['cost'];
                    $i++;
                }
            } ?>
            <?php
            if(isset($applicant['ApplicationToCharge'])) {
                foreach($applicant['ApplicationToCharge'] as $key=>$charge) {
                    $i = $i + 1;
                    $subs_text[$i]['item_name'] = $charge['HandlingCharge']['name'];
                    $subs_text[$i]['amount'] = $charge['HandlingCharge']['fees'];
                }
            } ?>
            <?php
            echo $this->Paypal->button('Pay', array(
                'type' => 'cart',
                'items' => $subs_text
            ), '',
               array('app_id' => $applicant['Applicant']['id'], 'notify_url' => SITE_URL.'paypal_ipn/process', 'return' => SITE_URL, 'cancel_return' => SITE_URL));
            ?>
            <?php } else {
                echo "Paid";
            } ?>
        </td>
        <td><a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'subscription_details', $applicant['Applicant']['id'])) ?>" class="details">Details</a></td>
      </tr>
    <?php } ?>
   <?php } else { ?>
    <tr>
        <td colspan="8">Record Not Found</td>
    </tr>
    <?php } ?>
    </tbody>
  </table>
		</div>
	</div>
</div>
</div>