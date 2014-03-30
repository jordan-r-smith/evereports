$('.collapse').collapse();

$(function () {
    var active = true;

    $('#collapse-init').click(function () {
        if (active) {
            active = false;
            $('.panel-collapse').collapse('show');
            $('.panel-title').attr('data-toggle', '');
            $('#collapse-init').html('Collapse all groups <span class="glyphicon glyphicon-resize-small"></span>');
        } else {
            active = true;
            $('.panel-collapse').collapse('hide');
            $('.panel-title').attr('data-toggle', 'collapse');
            $('#collapse-init').html('Expand all groups <span class="glyphicon glyphicon-resize-full"></span>');
        }
    });
});