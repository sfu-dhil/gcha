<?php
function tag_word_cloud()
{
    $tagTable = get_db()->getTable('Tag');
    $select = $tagTable->getSelectForFindBy([
        'type' => 'Item'
    ]);
    $tagTable->applySorting($select, 'count', 'DESC');
    $select->limit(500);
    $tags = $tagTable->fetchObjects($select);

    // $tags = get_db()->getTable('Tag')->findBy(array('type'=>'Item'));
    $tags_json = htmlspecialchars(json_encode($tags), ENT_QUOTES);
    $html = '
        <div id="tag-word-cloud-container">
            <h2>'.__('Tag Word Cloud').'</h2>
            <div id="tag-word-cloud" data-tags="'.$tags_json.'">
                '.__('No tags are available.').'
            </div>
        </div>
    ';
    $html = apply_filters('tag_word_cloud', $html);
    return $html;
}
