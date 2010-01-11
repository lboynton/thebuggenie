<?php

	$tbg__response->setTitle(__('Configure uploads &amp; attachments'));
	
?>
<script type="text/javascript">

	function toggleSettings()
	{
		if ($('enable_uploads_yes').checked)
		{
			$('upload_restriction_mode').enable();
			$('upload_extensions_list').enable();
			$('upload_storage').enable();
			if ($('upload_storage').getValue() == 'files')
			{
				$('upload_localpath').enable();
			}
		}
		else
		{
			$('upload_restriction_mode').disable();
			$('upload_extensions_list').disable();
			$('upload_storage').disable();
			$('upload_localpath').disable();
		}
	}

</script>
<table style="table-layout: fixed; width: 100%" cellpadding=0 cellspacing=0>
	<tr>
		<?php include_component('configleftmenu', array('selected_section' => TBGSettings::CONFIGURATION_SECTION_UPLOADS)); ?>
		<td valign="top">
			<div class="configheader" style="width: 750px;"><?php echo __('Configure uploads &amp; attachments'); ?></div>
			<?php if ($access_level == configurationActions::ACCESS_FULL): ?>
				<form accept-charset="<?php echo TBGContext::getI18n()->getCharset(); ?>" action="<?php echo make_url('configure_files'); ?>" method="post" onsubmit="submitForm('<?php echo make_url('configure_files'); ?>', 'config_uploads'); return false;" id="config_uploads">
			<?php endif; ?>
					<table style="clear: both; width: 700px; margin-top: 5px;" class="padded_table" cellpadding=0 cellspacing=0>
						<tr>
							<td style="width: 200px;"><label for="enable_uploads_yes"><?php echo __('Enable uploads'); ?></label></td>
							<td style="width: auto;">
								<?php if ($access_level == configurationActions::ACCESS_FULL): ?>
									<input type="radio" name="enable_uploads" value="1" id="enable_uploads_yes"<?php if (TBGSettings::isUploadsEnabled()): ?> checked<?php endif; ?> onclick="toggleSettings();"><label for="enable_uploads_yes"><?php echo __('Yes'); ?></label>&nbsp;&nbsp;
									<input type="radio" name="enable_uploads" value="0" id="enable_uploads_no"<?php if (!TBGSettings::isUploadsEnabled()): ?> checked<?php endif; ?> onclick="toggleSettings();"><label for="enable_uploads_no"><?php echo __('No'); ?></label>
								<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td class="config_explanation" colspan="2"><?php echo __('If uploads are disabled, users will not be able to attach files to issues or upload documents, images or PDFs in project planning. If you just want to allow one or the other, then enable this setting and use the permissions configuration.'); ?></td>
						</tr>
						<tr>
							<td><label for="upload_restriction_mode"><?php echo __('Upload restrictions'); ?></label></td>
							<td>
								<select name="upload_restriction_mode" id="upload_restriction_mode"<?php if (!TBGSettings::isUploadsEnabled()): ?> disabled<?php endif; ?>>
									<option value="whitelist"<?php if (TBGSettings::getUploadsRestrictionMode() == 'whitelist'): ?> selected<?php endif; ?>><?php echo __('Use a whitelist (only allow the following of extensions)'); ?></option>
									<option value="blacklist"<?php if (TBGSettings::getUploadsRestrictionMode() == 'blacklist'): ?> selected<?php endif; ?>><?php echo __('Use a blacklist (allow everything except the following extensions)'); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label for="upload_extensions_list"><?php echo __('Allowed / denied extensions'); ?></label></td>
							<td>
								<input type="text" name="upload_extensions_list" id="upload_extensions_list" style="width: 250px;" value="<?php echo implode(',', TBGSettings::getUploadsExtensionsList()); ?>"<?php if (!TBGSettings::isUploadsEnabled()): ?> disabled<?php endif; ?>>
							</td>
						</tr>
						<tr>
							<td class="config_explanation" colspan="2">
								<?php echo __('A space-, comma- or semicolon-separated list of extensions used to filter uploads, based on the %upload_restrictions% setting above.', array('%upload_restrictions%' => '<i><b>'.__('Upload restrictions').'</i></b>')); ?><br>
								<?php echo '<b>' . __('Ex: "%example_1%" or "%example_2%" or "%example_3%"', array('%example_1%' => '</b><i>txt doc jpg png</i>', '%example_2%' => '<i>txt,doc,jpg,png</i>', '%example_3%' => '<i>txt;doc;jpg;png</i>')); ?>
							</td>
						</tr>
						<tr>
							<td><label for="upload_storage"><?php echo __('File storage'); ?></label></td>
							<td>
								<select name="upload_storage" id="upload_storage"<?php if (!TBGSettings::isUploadsEnabled()): ?> disabled<?php endif; ?>>
									<option value="files"<?php if (TBGSettings::getUploadStorage() == 'files'): ?> selected<?php endif; ?> onchange="(this.value == 'files') ? $('upload_location').enable() : $('upload_location').disable();"><?php echo __('Store it in the folder specified below'); ?></option>
									<option value="database"<?php if (TBGSettings::getUploadStorage() == 'database'): ?> selected<?php endif; ?>><?php echo __('Use the database to store files'); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="config_explanation" colspan="2"><?php echo __('Specify whether you want to use the filesystem or database to store uploaded files. Using the database will make it easier to move your installation to another server.'); ?></td>
						</tr>
						<tr>
							<td><label for="upload_localpath"><?php echo __('Upload location'); ?></label></td>
							<td>
								<input type="text" name="upload_localpath" id="upload_localpath" style="width: 250px;" value="<?php echo (TBGSettings::getUploadsLocalpath() != "") ? TBGSettings::getUploadsLocalpath() : TBGContext::getIncludePath() . 'files/'; ?>"<?php if (!TBGSettings::isUploadsEnabled()): ?> disabled<?php endif; ?>>
							</td>
						</tr>
						<tr>
							<td class="config_explanation" colspan="2"><?php echo __("If you're storing files on the filesystem, specify where you want to save the files, here. Default location is the %files% folder in the main folder (not the public folder)", array('%files%' => '<b>files/</b>')); ?></td>
						</tr>
					</table>
			<?php if ($access_level == configurationActions::ACCESS_FULL): ?>
					<div class="rounded_box" style="margin: 5px 0px 5px 0px; width: 700px;">
						<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
						<div class="xboxcontent" style="vertical-align: middle; height: 23px; padding: 5px 10px 5px 10px;">
							<div style="float: left; font-size: 13px; padding-top: 2px;"><?php echo __('Click "Save" to save your changes in all categories'); ?></div>
							<input type="submit" id="config_uploads_button" style="float: right; padding: 0 10px 0 10px; font-size: 14px; font-weight: bold;" value="<?php echo __('Save'); ?>">
							<span id="config_uploads_indicator" style="display: none; float: right;"><?php echo image_tag('spinning_20.gif'); ?></span>
						</div>
						<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
					</div>
				</form>
			<?php endif; ?>
		</td>
	</tr>
</table>