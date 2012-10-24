$(document).ready(function(){
    $('a.expander').click(function() {
        $(this).toggle().next('span.spoiler').toggle();
        return false;
    });
    $('a.collapser').click(function() {
        $(this).parent('span.spoiler').toggle().prev('a.expander').toggle();
        return false;
    });
});

