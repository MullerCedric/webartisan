<?php $langFilter = get_query_var('language') ? rtrim(get_query_var('language'), '#') : '' ?>
<form action="#" method="get" class="o-wrapper o-wrapper--smaller c-filters"><?php
    $existingTerms = get_terms([
        'taxonomy' => 'language',
        'hide_empty' => true,
    ]);

    echo '<label class="c-filters__label"><span class="sr-only">' . __('Langage', 'webartisan') . '</span>';
    echo '<select name="language" class="c-filters__select">';
    echo '<option value="">' . __('Tous les langages', 'webartisan') . '</option>';
    foreach ($existingTerms as $lang) {
        $selected = $lang->slug === $langFilter ? ' selected' : '';
        echo '<option value="' . $lang->slug . '"' . $selected . '>' . $lang->name . '</option>';
    }
    echo '</select></label>';
    echo '<button class="c-filters__button">' . __('Filtrer', 'webartisan') . '</button>'; ?>
</form>
