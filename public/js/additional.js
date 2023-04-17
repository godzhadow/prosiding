$(document).ready(function() {

    $('.dropify').dropify({
        // messages: {
        //     'default': 'Drag and drop only pdf file here or click',
        // }
    }
    );
    // $('.dropifypayment').dropify({
    //     messages: {
    //         'default': 'Drag and drop jpg,png,jpeg,pdf file here or click',
    //     }
    // }
    // );
    // $('.dropifyprofile').dropify({
    //     tpl: {
    //         message:         '<div class="dropify-message"><span class="file-icon" /> <p>Drag and drop jpg,png,jpeg file here or click</p></div>',
    //         preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
    //     }
    // }
    // );

    // $('input[name=tags]').tagsInput();


    // $("#next-step").click(function() {
    //     $("#v-pills-task-tab").trigger('click');
    //   });
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });

});
