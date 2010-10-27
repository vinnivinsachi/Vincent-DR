// Execute this after the site is loaded.
$j(function() {
    // Find list items representing folders and
    // style them accordingly.  Also, turn them
    // into links that can expand/collapse the
    // tree leaf.
    $j('ul.folding-list li > ul').each(function(i) {
        // Find this list's parent list item.
        var parent_li = $j(this).parent('li');

        // Style the list item as folder.
        parent_li.addClass('folder');

        // Temporarily remove the list from the
        // parent list item, wrap the remaining
        // text in an anchor, then reattach it.
        var sub_ul = $j(this).remove();
        parent_li.wrapInner('<a/>').find('a').click(function() {
            // Make the anchor toggle the leaf display.
            sub_ul.toggle(200);
        });
        parent_li.append(sub_ul);
    });

    // Hide all lists except the outermost.
    $j('ul ul').hide();
});
