$(function(){
    $(".update_or_delete").on("click", function(){
        var form = $(this).parents('form');
        var task_id = $(this).closest('tr').find('input[name="task_id_td"]').val()
        var task_name = $(this).closest('tr').find('input[name=task_name_td]').val();
        var remarks = $(this).closest('tr').find('input[name=remarks_td]').val();
        var deadline = $(this).closest('tr').find('input[name=deadline_td]').val();
        $('input[name="task_id"]').val(task_id);
        $('input[name="task_name"]').val(task_name);
        $('input[name="remarks"]').val(remarks);
        $('input[name="deadline"]').val(deadline);
        form.submit();
    });
});