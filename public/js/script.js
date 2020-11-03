$(function() {

    $(".videos .video a").on('click', function(e) {
        e.preventDefault();

        let link = $(this).attr('href');
        $(".modal div .modal-content .modal-body iframe").attr('src', link);
    });

    $(".quiz.disabled a").click(function(e) {
        e.preventDefault();
    });


    $("#upload_btn").on('click', function(e) {
        e.preventDefault();

        if($("#upload_btn").attr('class') != "btn btn-success save_image") {
            $("#image_file").trigger('click');
        }else {

            // for submit
            $("#form").submit();

        }
    });

    $("#image_file").on("change", function() {

        let image_value = $(this).val();

        $("#upload_btn").html("<i class='fas fa-cloud-upload-alt'></i> Save");
        $("#upload_btn").attr('class', 'btn btn-success save_image');
        $("#upload_btn").css('width', '100px');
    });
$("#form").on('submit',function (e) {
    e.preventDefault();
   $.ajax({
       url:'profile',
       type:'POST',
       dataType: 'JSON',
       contentType: false ,
       successDate: function (data) {
           console.log(data);

           $("#message").text(data.message);
           $("#uploaded_image").html(data.uplouded_image);
           
       }
       
   })
});

});
