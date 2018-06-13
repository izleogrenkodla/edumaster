<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN DASHBOARD STATS -->
        <?php echo $this->Session->flash(); ?>
        <?php // echo $this->Session->flash('auth'); ?>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php echo $Applicant_result; ?>
                        </div>
                        <div class="desc">
                            No. Applicant
                        </div>
                    </div>
                    <a class="more" href="<?php echo Router::url(array('controller' => 'Applicants', 'action' => 'index'))?>">
                        View All <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php echo $Agent_result; ?>
                        </div>
                        <div class="desc">
                            Total Agent Register
                        </div>
                    </div>
                    <a class="more" href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'index_agent'))?>">
                        View All <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php echo $College_result; ?>
                        </div>
                        <div class="desc">
                            Total College Register
                        </div>
                    </div>
                    <a class="more" href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'index_college'))?>">
                        View All <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php echo $total_users; ?>
                        </div>
                        <div class="desc">
                            Total User
                        </div>
                    </div>
                    <a class="more" href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'index'))?>">
                        View All <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php echo $Direct_result; ?>
                        </div>
                        <div class="desc">
                            Total Direct Applicant
                        </div>
                    </div>
                    <a class="more" href="<?php echo Router::url(array('controller' => 'Applicants', 'action' => 'direct'))?>">
                        View All <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- END DASHBOARD STATS -->
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />


    </div>
</div>