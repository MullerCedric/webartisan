<div class="page-numbers__container page-numbers__container--top">
    <?php
    $allVisiblePossibilities = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'xyz', '0-9', ':'
    ];
    $existingTerms = get_terms([
        'taxonomy' => 'alphabetical',
        'hide_empty' => true,
    ]);
    $existingTermsNames = array_column($existingTerms, 'name');
    foreach ($allVisiblePossibilities as $letter) {
        if (in_array($letter, $existingTermsNames)) {
            echo '<a href="#' . $letter . '" class="page-numbers">' . strtoupper($letter) . '</a>';
        } else {
            echo '<span class="page-numbers dots">' . strtoupper($letter) . '</span>';
        }
    } ?>
</div>
