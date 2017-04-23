<h1>Remaing Proficiencies</h1>
<form name="savChar" id="savChar" novalidate>
	<p><label for="classProfs">Select ({{chInCont.skillCap}}) Class Skill Proficiencies: </label><br /><br />
		<select name="classProfs" id="classProfs" ng-model="chInCont.chosenProfs" data-ng-attr-size="{{curClassProfs.length}}" ng-change="chInCont.ClassProfsCheck()" ng-options="clasSkill.name for clasSkill in curClassProfs track by clasSkill.class_prof_id" multiple required></select>
	</p>
	<p ng-show="addChar.class_build.class.class_id == 9"><label for="classProfs">Select ({{chInCont.expCap}}) Skill Expertise: </label><br />
		<select name="expProfs" id="expProfs" ng-model="chInCont.expProfs" data-ng-attr-size="{{chInCont.rExpProfs.length}}" ng-change="chInCont.ExpProfsCheck()" ng-options="clasSkill.name for clasSkill in chInCont.rExpProfs track by clasSkill.class_prof_id" multiple></select>
	</p>
	<p><div ng-click="chInCont.BackStep()" class="back_butt button"><span class="button_text">Back</span></div> --- <div ng-click="chInCont.SaveChar()" class="next_butt button"><span class="button_text">Save Character</span></div></p>
</form>
