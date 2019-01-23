//Отправка формы
$("button[type='submit']").click(function(e) {
    $(this).attr('disabled', true);    

    $.ajax({
        url: '/tasks/' + taskId + '/edit/',
        type: 'POST',
        dataType: 'json',
        data: $("form[name='task_form']").serialize(),
        success:function(r){
            if (r.status === 'ok') {
                $("div.result-container").addClass("alert-success")
                        .removeClass("alert-danger");
            } else {
                $("div.result-container").addClass("alert-danger")
                        .removeClass("alert-success");
            }
            $("div.result-container").html(r.message).fadeIn();
            
            //из соображений простоты. Можно сделать, понятно, и, например, 
            //через Bootstrap Notify
            setTimeout(function(){
                $("div.result-container").fadeOut();
            }, 3000);
            
            $("button[type='submit']").removeAttr('disabled');
        }
    });
});


