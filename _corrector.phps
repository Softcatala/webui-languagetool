	<link href="/languagetool/css/style.css?2" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/languagetool/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" href="/languagetool/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type="text/javascript">
		$(document).ready(function() {
			$("a.fancyboxImage").fancybox({
				'hideOnContentClick': true,
				'titlePosition': 'inside'
			});
		});
    </script>
    <script language="javascript" type="text/javascript" src="/languagetool//online-check/tiny_mce/tiny_mce.js"></script>
    <script language="javascript" type="text/javascript" src="/languagetool//online-check/tiny_mce/plugins/atd-tinymce/editor_plugin.js"></script>
    <script language="javascript" type="text/javascript">

		tinyMCE.init({
			mode : "textareas",
			plugins : "AtD,paste",

			//Keeps Paste Text feature active until user deselects the Paste as Text button
			paste_text_sticky : true,
			//select pasteAsPlainText on startup
			setup : function(ed) {
				ed.onInit.add(function(ed) {
					ed.pasteAsPlainText = true;
				});
			},

			/* translations: */
			languagetool_i18n_no_errors :
			{
				'ca': 'No s\'ha trobat cap error'
			},
			languagetool_i18n_explain :
			{
				// "Explain..." - shown if there's an URL with a more detailed description:
				'ca': 'Més informació…'
			},
			languagetool_i18n_ignore_once :
			{
				'ca': 'Ignora el suggeriment'
			},
			languagetool_i18n_ignore_all :
			{
				'ca': 'Ignora aquesta classe d\'errors'
			},

			languagetool_i18n_current_lang :    function() { return document.checkform.lang.value; },
			/* the URL of your proxy file: */
			languagetool_rpc_url                 : "/languagetool/online-check/tiny_mce/plugins/atd-tinymce/server/proxy.php?url=",
			/* edit this file to customize how LanguageTool shows errors: */
			languagetool_css_url                 : "/languagetool/online-check/tiny_mce/plugins/atd-tinymce/css/content.css",
			/* this stuff is a matter of preference: */
			theme                              : "advanced",
			theme_advanced_buttons1            : "",
			theme_advanced_buttons2            : "",
			theme_advanced_buttons3            : "",
			theme_advanced_toolbar_location    : "none",
			theme_advanced_toolbar_align       : "left",
			theme_advanced_statusbar_location  : "bottom",  // activated so we have a resize button
			theme_advanced_path                : false,     // don't display path in status bar
			theme_advanced_resizing            : true,
			theme_advanced_resizing_use_cookie : false,
			/* disable the gecko spellcheck since AtD provides one */
			gecko_spellcheck                   : false
		});

		 function doit() {
			 var langCode = document.checkform.lang.value;
			 //formes: generals/valencianes/balears
			 var catOptions = $("input[name=formes]:checked").val(); 
			 //opcions dins formes valencianes
			 if (catOptions == "formes_valencianes") 
			 {
				catOptions = catOptions + "," + $("input[name=accentuacio]:checked").val()
										+  "," + $("input[name=incoatius]:checked").val()
										+  "," + $("input[name=incoatius2]:checked").val()
										+  "," + $("input[name=demostratius]:checked").val(); 
			 }
			 // opcions per a les tres variants
			 catOptions = catOptions + "," + $("input[name=SE_DAVANT_SC]:checked").val()
									 + "," + $("input[name=CA_UNPAIRED_QUESTION]:checked").val();
			 tinyMCE.activeEditor.execCommand('mceWritingImprovementTool', langCode, catOptions);
		 }
     </script>
  <?php } ?>

</head>
<body>
<?php
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
			<input type="checkbox" id="mesopcions" value="mesopcions" onClick="mostraMesOpcions()">Mostra més opcions 
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

<script language="javascript" type="text/javascript">
	function mostraMesOpcions()
	{
		if (document.getElementById('mesopcions').checked==true)
		{
			document.getElementById('mes_opcions').style.display='';
		}
		else
		{
			document.getElementById('mes_opcions').style.display='none';
		};
	}
</script>
