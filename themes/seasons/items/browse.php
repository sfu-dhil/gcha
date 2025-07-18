<?php
$pageTitle = __('Browse Items');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php echo item_search_filters(); ?>

<?php echo pagination_links(['attributes' => ['aria-label' => __('Top pagination')]]); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date')] = 'Dublin Core,Date';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>

<?php foreach (loop('items') as $item): ?>
<div class="item hentry">
    <h2><?php echo link_to_item(null, array('class' => 'permalink')); ?></h2>
    <div class="item-meta">
        <?php if (metadata('item', 'has files')): ?>
        <div class="item-img">
            <?php echo link_to_item(item_image(null)); ?>
        </div>
        <?php endif; ?>

        <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
        <div class="item-description">
            <?php echo $description; ?>
        </div>
        <?php endif; ?>

        <?php if ($metadataCreator = metadata('item', array('Dublin Core', 'Creator'))): ?>
        <div><strong><?php echo __('Creator'); ?>:</strong>
            <?php echo $metadataCreator; ?>
        </div>
        <?php endif; ?>

        <?php if ($metadataDate = metadata('item', array('Dublin Core', 'Date'))): ?>
        <div><strong><?php echo __('Date'); ?>:</strong>
            <?php echo $metadataDate; ?>
        </div>
        <?php endif; ?>

        <?php if ($metadataIdentifier = metadata('item', array('Dublin Core', 'Identifier'))): ?>
        <div><strong><?php echo __('Identifier'); ?>:</strong>
            <?php echo $metadataIdentifier; ?>
        </div>
        <?php endif; ?>

        <?php if ($metadataSubject = metadata('item', array('Dublin Core', 'Subject'))): ?>
        <div><strong><?php echo __('Subject'); ?>:</strong>
            <?php echo $metadataSubject; ?>
        </div>
        <?php endif; ?>

        <?php if (metadata('item', 'has tags')): ?>
        <div class="tags"><strong><?php echo __('Tags'); ?>:</strong>
            <?php echo tag_string('items'); ?>
        </div>
        <?php endif; ?>

        <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>
    </div><!-- end class="item-meta" -->
</div><!-- end class="item hentry" -->
<?php endforeach; ?>

<?php echo pagination_links(['attributes' => ['aria-label' => __('Bottom pagination')]]); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>

<?php echo foot(); ?>