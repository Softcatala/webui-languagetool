		$(document).ready(function() {
			$("a.fancyboxImage").fancybox({
				'hideOnContentClick': true,
				'titlePosition': 'inside'
			});
			
			$("#mesopcions").click(function () {
				$("#mes_opcions").toggle(this.checked);
			});
			
			$('#submit').click(function() {
				doit();
				return false;
			});
			
			$('#check_formes_generals').click(function() {
				$('#opcions_valencia').hide();
			});
			
			$('#check_formes_valencianes').click(function() {
				$('#opcions_valencia').show();
			});
			
			$('#check_formes_balears').click(function() {
				$('#opcions_valencia').hide();
			});
			
			$('#finalitza').click(function() {
				text = tinymce.editors[0].core.getPlainText();
				$('#submit').toggle();
				$('#checktextpara').toggle();
				$('#copytextarea').text(text);
				$('#copytextarea').toggle();
		});
		
		tinyMCE.init({
			mode : "specific_textareas",
			editor_selector : "checktext"
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
