<div ng-show="mainCont.CurOverScreen(2)" ng-controller="charInsertController as chInCont" class="sixty_he">
	<div class="left_page_col left_page_det" ng-show="chInCont.showDetails">
		<img ng-src="{{chInCont.detail_img}}" class="detail_img" />
		<p>{{chInCont.detail_desc}}</p>
	</div>
	<div>
		<div ng-show="chInCont.CurStep(1)" class="right_page fade_in">
			<?php $this->load->view("main/characters/add/playchar_in.php"); ?>
		</div>
		<div ng-show="chInCont.CurStep(2)" class="right_page fade_in">
			<?php $this->load->view("main/characters/add/sel_race.php"); ?>
		</div>
		<div ng-show="chInCont.CurStep(3)" class="right_page fade_in">
			<?php $this->load->view("main/characters/add/race_in.php"); ?>
		</div>
		<div ng-show="chInCont.CurStep(4)" class="right_page fade_in">
			<?php $this->load->view("main/characters/add/sel_class.php"); ?>
		</div>
		<div ng-show="chInCont.CurStep(5)" class="right_page fade_in">
			<?php $this->load->view("main/characters/add/sel_bg.php"); ?>
		</div>
		<div ng-show="chInCont.CurStep(6)" class="right_page fade_in">
			<?php $this->load->view("main/characters/add/rev_ins.php"); ?>
		</div>
		<div ng-click="chInCont.Cancel()" class="cancel_butt button"><span class="button_text">X</span></div>
	</div>
</div>
