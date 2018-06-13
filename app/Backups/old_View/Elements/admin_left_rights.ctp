<div class="page-sidebar-wrapper">
<div class="page-sidebar navbar-collapse collapse">
					
<ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
<li >
		<div class="col-md-12">
		<div class="top-news">
		<?php if(in_array($authUser['ROLE_ID'],array(STUDENT_ID,TEACHER_ID))) { ?>
		<a href="#" class="btn red">
								<?php if(in_array($authUser['ROLE_ID'],array(STUDENT_ID))) { ?>
								<span> Monthly Attendance </span>
							<?php } ?>
							<?php if(in_array($authUser['ROLE_ID'],array(TEACHER_ID))) { ?>
								<span> Today's Attendance </span>
							<?php } ?>	
								<em>No. of Present &nbsp;: <?php echo $present_cnt ?></em>
								<em>No. of Absent &nbsp;: <?php echo $absent_cnt ?></em>
								<?php if(in_array($authUser['ROLE_ID'],array(STUDENT_ID))) { ?>
								<em>Holiday &nbsp;: <?php echo $holiday_cnt ?></em>
								<?php } ?>
									<i class="fa fa-user top-news-icon"></i>
								</a>
								<?php } ?>
								<a href="#" class="btn blue">
								<?php if(in_array($authUser['ROLE_ID'],array(TEACHER_ID,STUDENT_ID))) { ?>
								<span>Leaves </span>
								<?php }else{ ?>
								<span>Teacher Leaves </span>								
								<?php  } ?>
								<em>Total Leaves &nbsp;: <?php echo $total_leaves_cnt ?></em>
								<em>Approved  &nbsp;: <?php echo $approve_leaves_cnt ?></em>
								<em>UnApproved &nbsp;: <?php echo $unapprove_leaves_cnt ?></em>
								<em>Reject  &nbsp;: <?php echo $reject_leaves_cnt ?></em>
								<i class="fa fa-globe top-news-icon"></i>
								</a>
		</div>
		</div>
    
</li>
<li>
		<div class="col-md-12">
		<div class="">
                    <canvas id="canvas" width="205" height="205" style="background-color:#4484F1"></canvas>
                </div>
		</div>
	
</li>



</ul>					
</div>
</div>
<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>