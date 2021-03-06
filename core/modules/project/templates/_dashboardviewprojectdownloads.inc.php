<?php

    $found = false;
    
    foreach ($editions as $releases)
    {
        if (array_key_exists(0, $releases))
        {
            $found = true;
            
            if ($releases[0]->getEdition() instanceof \thebuggenie\core\entities\Edition)
                echo '<div class="tab_header">'.$releases[0]->getEdition()->getName().'</div>';

            echo '<ul class="simple_list">'.get_component_html('project/release', array('build' => $releases[0])).'</ul>';
        }
    }
    
    if ($found == false)
    {
        ?><div class="content no-items">
            <?= fa_image_tag('download'); ?>
            <span><?php echo __('There are no downloadable releases at the moment'); ?></span>
            <?php if ($tbg_user->canEditProjectDetails($project)): ?>
                <?php if ($project->isBuildsEnabled()): ?>
                    <?php echo link_tag(make_url('project_release_center', array('project_key' => $project->getKey())), __('Manage project releases'), ['class' => 'button button-silver']); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div><?php
    }
    
?>
