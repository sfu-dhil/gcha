<?php if (metadata('item', 'has files')): ?>
    <p class="explanation"><?php echo __('Click and drag the files into the preferred display order.'); ?></p>
    <div id="file-list">
        <ul class="sortable">
        <?php foreach( $item->Files as $key => $file ): ?>
            <li class="file">
                <div class="sortable-item">
                    <?php echo file_image('square_thumbnail', array(), $file); ?>
                    <?php echo link_to($file, 'show', html_escape($file->original_filename), array()); ?>
                    <?php echo $this->formHidden("order[{$file->id}]", $file->order, array('class' => 'file-order')); ?>
                    <ul class="action-links">
                        <li><?php echo link_to($file, 'edit', __('Edit'), array('class'=>'edit')); ?></li>
                        <li><a href="#" class="delete"><?php echo __('Delete '); ?></a> <?php echo $this->formCheckbox('delete_files[]', $file->id, array('checked' => false)); ?></li>
                    </ul>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="add-new"><?php echo __('Add New Files'); ?></div>
<div class="drawer-contents">
    <p><?php echo __('The maximum file size is %s.', max_file_size()); ?></p>

    <div class="field two columns alpha" id="file-inputs">
        <label><?php echo __('Find a File'); ?></label>
        <button type="button" id="add-file" class="add-file button"><?php echo __('Add Another File'); ?></button>
    </div>

    <?php
    $fileTemplate = <<<FILE_TEMPLATE
    <div class="file-container">
        <input name="file[__INDEX__]" type="file" class="file-input" multiple>
        <div class="file-info">
            <div class="file-thumbnail"></div>
            <div class="file-size"></div>
        </div>
    </div>
FILE_TEMPLATE;
    ?>
    <div class="files four columns omega" data-file-container-template="<?php echo utf8_htmlspecialchars($fileTemplate); ?>"></div>
</div>

<?php fire_plugin_hook('admin_items_form_files', array('item' => $item, 'view' => $this)); ?>
