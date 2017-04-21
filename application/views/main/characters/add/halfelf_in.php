<div class="right_page_in right_page_in_add">
	<h1>Racial Characteristics:</h1>
	<form id="insHElfInfo" name="insHElfInfo" novalidate>
		<p><span><label for="halfElfAbil">Select (2) Ability Mods:</label></span><span>
		<select name="halfElfAbil" id="halfElfAbil" size="5" ng-model="chInCont.halfElfAbil" ng-change="chInCont.HElfAbilCheck()" multiple required>
			<option value="str">Strength</option>
			<option value="dex">Dexterity</option>
			<option value="con">Constitution</option>
			<option value="int">Intelligence</option>
			<option value="wis">Wisdom</option>
		</select></span></p>
		<p><span><label for="halfElfAbil">Select (2) Skill Proficiencies:</label></span>
			<span><select name="halfElfSkil" id="halfElfSkil" ng-model="chInCont.halfElfSkil" ng-change="chInCont.HElfSkilCheck()" data-ng-attr-size="{{chInCont.allProfs.length}}" ng-options="prof.name group by prof.group for prof in chInCont.allProfs track by prof.s_code" multiple required></select></span>
		</p>
		<p><div ng-click="chInCont.BackStep()" class="back_butt button"><span class="button_text">Back</span></div> --- <div ng-show="insHElfInfo.$valid" ng-click="chInCont.SubmitHElfInfo()" class="next_butt button"><span class="button_text">Next</span></div></p>
	</form>
</div>
