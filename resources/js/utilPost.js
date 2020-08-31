$(()=>{
    $('#blog').on('change', function() {
        // console.log(this.value);
        if($('#title').attr('data-changed') == "false" || $('#title').val()=="") {

            $('#title').val($(this).find(":selected").html());
            $('#title').attr('data-changed', "false");
        }
    });

    $('#title').keypress(function() {
        $(this).attr('data-changed', 'true');
    })
})