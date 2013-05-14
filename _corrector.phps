<?php
	drupal_add_js("/languagetool/js/fancybox/jquery.fancybox-1.3.4.pack.js");
	drupal_add_js("/languagetool/js/fancybox/jquery.fancybox-1.3.4.css"); 
	drupal_add_js("/languagetool/online-check/tiny_mce/tiny_mce.js"></script>
	drupal_add_js("/languagetool/online-check/tiny_mce/plugins/atd-tinymce/editor_plugin.js");
	drupal_add_js("/languagetool/languagetool.js");

	$checkDefaultLang = "ca";
?>

<form name="checkform" action="http://community.languagetool.org" method="post">
	<p id="checktextpara">
		<textarea id="checktext" name="text" style="width: 100%" rows="6">
			<?php print $checkDefaultText ?>
		</textarea>
	</p>

	<div style="margin-top:0px;">
		<input type="hidden" name="lang" value="<?php print $checkDefaultLang ?>"/>
		<div style="margin-top:0px; margin-left: 30px; display:block; float: left;">
			Formes 
			<input type="radio" name="formes" value="formes_generals" checked onClick="document.getElementById('opcions_valencia').style.display='none';">generals
			<input type="radio" name="formes" value="formes_valencianes" onClick="document.getElementById('opcions_valencia').style.display='';">valencianes
			<input type="radio" name="formes" value="formes_balears" onClick="document.getElementById('opcions_valencia').style.display='none';">balears
		</div>

		<div style="margin-top:0px; margin-left: 30px; display:block; float: left;">
			<input type="checkbox" id="mesopcions" value="mesopcions">Mostra més opcions 
			<div id="mes_opcions" style="display:none; background-color:#BDBDBD;">
				<input type="checkbox" name="SE_DAVANT_SC" value="SE_DAVANT_SC" checked>Exigeix 'se' (se sap, se celebra)<br/>
				<input type="checkbox" name="CA_UNPAIRED_QUESTION" value="CA_UNPAIRED_QUESTION">Exigeix signe d'interrogació inicial (¿)<br/>

				<div id="opcions_valencia" style="margin-top:0px; display:block; background-color:#BDBDBD; float: left;display:none;" >   	
					<table summary="" border="0">
						<tr>
							<td>Accentuació:</td>
							<td><input type="radio" name="accentuacio" value="accentuacio_general" checked>general (cafè)</td>
							<td><input type="radio" name="accentuacio" value="accentuacio_valenciana">valenciana (café)</td>
						</tr>
						<tr>
							<td>Verbs incoatius:</td>
							<td><input type="radio" name="incoatius" value="incoatius_eix" checked>-eix (serveix)</td>
							<td><input type="radio" name="incoatius" value="incoatius_ix">-ix (servix)</td>
						</tr>
						<tr>
						<td></td>
							<td><input type="radio" name="incoatius2" value="incoatius_esc">-esc (servesc)</td>
							<td><input type="radio" name="incoatius2" value="incoatius_isc" checked>-isc (servisc)</td>
						</tr>
						<tr>
							<td>Demostratius:</td>
							<td><input type="radio" name="demostratius" value="demostratius_aquest" checked>aquest</td>
							<td><input type="radio" name="demostratius" value="demostratius_este">este</td>
					</tr>
					</table>  
				</div>

			</div>
		</div>
		<div style="margin-top:0px; display:block; float: right;">
			<input type="submit" name="_action_checkText" value="<?php print $checkSubmitButtonValue ?>" onClick="doit();return false;">
		</div>
	</div>

</form>
