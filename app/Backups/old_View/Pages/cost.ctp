<div id="maincontent" class="leftcontent">
    <div class="pagetitle">Cost</div>
    <div class="pagedesc">
    <div class="page-content-wrapper">
        <div class="page-content">
            <?php echo $this->Session->flash(); ?>


        </div>
        <div class="innerpage" id="cost">
            <div class="data">How much will it cost? </div>
            <div class="data"> In case of Basic Service only CAIP/FOSS/GCMS report is provided in form of soft copy.</div>
            <div class="data">
                CAIPS report has technical terms and Language which might be difficult for general person to understand if you need more details as to what does your CAIPS /FOSS/GCMS reports says you can avail our Basic + interpretation of Notes Services.
            </div>
            <div class="data">
                Our premium package includes Notes, interpretation and recommendation as to what you should do, to improve your chances for Visas.
            </div>
            <div class="data">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr bgcolor="#D41A00">
                        <th width="83%">Service</th>
                        <th width="17%">Cost</th>
                    </tr>
                    <?php $i = 1;  foreach($subscriptions as $key=>$sub) {
                        if($i%2) {
                            $tst = 'bgcolor="#e1e1e1"';
                        } else { $tst = ''; } ?>
                    <tr <?php echo $tst; ?>>
                        <td><?php echo $sub['title']; ?></td>
                        <td><?php echo $sub['cost']; ?><p></p>
                        </td>
                    </tr>
                    <?php $i++; } ?>

                    </tbody></table></div>
            <div class="data right">
                <div class="costbtn"><a href="http://clickcare.in/staff/">REGISTER</a></div>
                <p></p></div>
        </div>
    </div>
    </div>
</div>