<div class="right_page_in">
	<h1>Racial Characteristics:</h1>
	<form id="insRaceInfo" name="insRaceInfo" novalidate>
		<div>
			<p class="underline_center">
				<span><label for="charAge">Character Age:</label></span>
				<span><i>(Adult Age: {{chInCont.aduAge}} - Max Age: {{chInCont.maxAge}})</i></span>
				<br />
				<span><input type="text" name="charAge" id="charAge" ng-model="addChar.race_build.age" maxlength="3" size="3" pattern="^[0-9]+$" required/></span>
			</p>
			<p class="underline_center">
				<span><label for="charHeight">Character Height:</label></span>
				<span><i>(Min: {{chInCont.minHeight}} - Max: {{chInCont.maxHeight}})</i></span>
				<br />
				<span><input type="text" name="charHFeet" id="charHFeet" ng-model="chInCont.chHeFe" maxlength="2" size="2" pattern="^[0-9]+$" required/>' <input type="text" name="charHInch" id="charHInch" ng-model="chInCont.chHeIn" maxlength="2" size="2" pattern="^[0-9]+$" required/>"</span>
			</p>
			<p class="underline_center">
				<span><label for="charWeight">Character Weight:</label></span>
				<span><i>(Min: {{chInCont.minWeight}} - Max: {{chInCont.maxWeight}})</i></span>
				<br />
				<span><input type="text" name="charWeight" id="charWeight" ng-model="addChar.race_build.weight" maxlength="3" size="3" pattern="^[0-9]+$" required/></span>
			</p>
		</div>
		<p><div ng-click="chInCont.BackStep()" class="back_butt button"><span class="button_text">Back</span></div> --- <div ng-show="insRaceInfo.$valid" ng-click="chInCont.SubmitRaceInfo()" class="next_butt button"><span class="button_text">Next</span></div></p>
	</form>
</div>
