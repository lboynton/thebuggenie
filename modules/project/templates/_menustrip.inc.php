<div class="menu_project_strip tab_menu">
	<div class="project_name<?php if (!$project instanceof TBGProject): ?> faded_dark<?php endif; ?>">
		<?php echo image_tag('spinning_32.gif', array('id' => 'project_menustrip_indicator', 'style' => 'display: none;')); ?>
		<span id="project_menustrip_name">
			<a href="javascript:void(0);" onclick="$('project_menustrip_change').toggle();" style="float: right; margin-left: 10px;<?php if ($tbg__response->getPage() != 'reportissue' && $show_report_button && count(TBGProject::getAll()) <= 1): ?> display: none;<?php endif; ?>" class="image"><?php echo image_tag('expand.png'); ?></a>
			<?php if (!$project instanceof TBGProject): ?>
				<?php echo __('There is no project selected'); ?>
			<?php else: ?>
				<?php echo $project->getName(); ?>
			<?php endif; ?>
		</span>
		<div class="rounded_box white" id="project_menustrip_change" style="position: absolute; display: none; width: 324px; top: 34px;">
			<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
			<div class="xboxcontent" style="padding: 5px;">
				<div class="dropdown_header"><?php echo __('Select a different project'); ?></div>
				<div class="dropdown_content">
					<?php if (count(TBGProject::getAll()) > 1): ?>
						<?php echo __('Choose a project from the list below'); ?>:<br>
						<table cellpadding="0" cellspacing="0">
							<?php foreach (TBGProject::getAll() as $aProject): ?>
								<?php if ($project instanceof TBGProject && $aProject->getID() == $project->getID()) continue; ?>
								<tr>
									<td style="width: 16px;"><?php echo image_tag($aProject->getIcon(), array('style' => 'float: left; margin-right: 5px;'), $aProject->hasIcon()); ?></td>
									<td style="padding-left: 5px; font-size: 13px;">
										<?php if (in_array($tbg__response->getPage(), array('project_dashboard', 'project_planning', 'project_scrum', 'project_issues', 'project_statistics', 'project_users', 'project_timeline'))): ?>
											<?php echo link_tag(make_url($tbg__response->getPage(), array('project_key' => $aProject->getKey())), $aProject->getName()); ?>
										<?php else: ?>
											<a href="javascript:void(0);" onclick="updateProjectMenuStrip('<?php echo make_url('getprojectmenustrip', array('page' => $tbg__response->getPage())); ?>', <?php echo $aProject->getID(); ?>);"><?php echo $aProject->getName(); ?></a>
										<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</table>
					<?php else: ?>
						<span class="faded_medium"><?php echo __('The are no other projects to choose from'); ?></span>
					<?php endif; ?>
					<div id="issuetype_spinning" style="margin-top: 3px; display: none;"><?php echo image_tag('spinning_20.gif', array('style' => 'float: left; margin-right: 5px;')) . '&nbsp;' . __('Please wait'); ?>...</div>
				</div>
				<div id="issuetype_change_error" class="error_message" style="display: none;"></div>
			</div>
			<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
		</div>
	</div>
	<?php if ($project instanceof TBGProject): ?>
		<div class="project_stuff">
		<ul>
			<li<?php if ($selected_tab == 'project_dashboard'): ?> class="selected"<?php endif; ?>><?php echo link_tag(make_url('project_dashboard', array('project_key' => $project->getKey())), __('Project dashboard')); ?></li>
			<li<?php if ($selected_tab == 'project_planning'): ?> class="selected"<?php endif; ?>><?php echo link_tag(make_url('project_planning', array('project_key' => $project->getKey())), __('Planning')); ?></li>
			<li<?php if ($selected_tab == 'project_scrum'): ?> class="selected"<?php endif; ?>><?php echo link_tag(make_url('project_scrum', array('project_key' => $project->getKey())), __('Scrum')); ?></li>
			<li<?php if (in_array($selected_tab, array('project_issues', 'viewissue'))): ?> class="selected"<?php endif; ?>><?php echo link_tag(make_url('project_issues', array('project_key' => $project->getKey())), __('Issues')); ?></li>
			<li<?php if ($selected_tab == 'project_team'): ?> class="selected"<?php endif; ?>><?php echo link_tag(make_url('project_team', array('project_key' => $project->getKey())), __('Team')); ?></li>
			<li<?php if ($selected_tab == 'project_statistics'): ?> class="selected"<?php endif; ?>><?php echo link_tag(make_url('project_statistics', array('project_key' => $project->getKey())), __('Statistics')); ?></li>
			<li<?php if ($selected_tab == 'project_timeline'): ?> class="selected"<?php endif; ?>><?php echo link_tag(make_url('project_timeline', array('project_key' => $project->getKey())), __('Timeline')); ?></li>
			<?php TBGContext::trigger('core', 'project_menustrip_item_links', array('project' => $project, 'selected_tab' => $selected_tab)); ?>
		</ul> 
		</div>
		<?php if ($tbg__response->getPage() != 'reportissue' && (!isset($hide_button) || (isset($hide_button) && $hide_button == false))): ?>
			<form action="<?php echo make_url('project_reportissue', array('project_key' => $project->getKey())); ?>" method="get" style="clear: none; display: inline; position: absolute; right: 3px; top: 3px;">
				<div class="report_button" style="width: 150px;"><input type="submit" value="<?php echo __('Report an issue'); ?>"></div>
			</form>
		<?php endif; ?>
	<?php endif; ?>
</div>