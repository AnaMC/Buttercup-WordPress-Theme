<?php
    comment_form();
    
    $args = array(
        'style' => 'div',
        'type' => 'comment',
        'callback' => 'custom_comments',
        'reply-text' => 'contesta'
        );
    wp_list_comments($args);