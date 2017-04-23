<?php $this->load->view("includes/main/header.php"); ?>
<body ng-controller="locManager as locM" ng-cloak>
	<div class="headDiv" id="headDiv">

	</div>
	<div class="mainDiv" id="forwardMain" ng-mousemove="locM.MoveBook($event)" ng-style="{'transform': 'rotateX('+locM.rotateDeg+'deg)', '-moz-transform': 'rotateX('+locM.rotateDeg+'deg)', '-webkit-transform': 'rotateX('+locM.rotateDeg+'deg)'}">
		<div ng-click="locM.Logout()" class="fright button"><span class="button_text">Logout</span></div>
		<!-- <div id="nav_panel">
			<ul>
				<li ng-click="locM.selectLoc(1)">Characters</li>
				<li ng-click="locM.selectLoc(2)">Campaigns</li>
			</ul>
		</div> -->
		<div id="charTab" class="page" ng-show="locM.isSelected(1)" ng-controller="mainCharController as mainCont">
			<?php $this->load->view("main/users.php"); ?>
			<?php $this->load->view("main/characters/add.php"); ?>
			<?php $this->load->view("main/characters/delete.php"); ?>
		</div>
		<div id="campTab" class="page" ng-show="locM.isSelected(2)" ng-controller="mainCampController as campCont">
			<?php $this->load->view("main/campaigns.php"); ?>
		</div>
	</div>
</body>
</html>
