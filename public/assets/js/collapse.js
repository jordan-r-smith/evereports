$('.collapse').collapse();

$(function () {
    var active = false;

    $('#collapse-init').click(function () {
        if (!active) {
            active = true;
            $('.panel-collapse').collapse('show');
            $('.panel-title').attr('data-toggle', 'collapse');
            $('#collapse-init').html('Collapse all groups <span class="glyphicon glyphicon-resize-small"></span>');
        } else {
            active = false;
            $('.panel-collapse').collapse('hide');
            $('.panel-title').attr('data-toggle', '');
            $('#collapse-init').html('Expand all groups <span class="glyphicon glyphicon-resize-full"></span>');
        }
    });
});