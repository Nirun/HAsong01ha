$(function(){
    $('#payment').bind('click',function(){
        alert('xxx');
        $(this).unbind('click');
    });
});
function removeThickBoxEvents() {
    $('.thickbox').each(function(i) {
        $(this).unbind('click');
    });
}

function bindThickBoxEvents() {
    removeThickBoxEvents();
    //tb_init('a.thickbox, area.thickbox, input.thickbox');
}