var allGrades_edit = [];

var editGrade = function (grade_edit,gradeId) {
    var resutlItem_edit = {
        grade_edit: grade_edit,
        gradeId : gradeId,
    };
    allGrades_edit.push(resutlItem_edit);
};

var buttonClicked_edit = function () {
    var grade_edit = $('.grade_edit');
    var gradeId = $('.grade_id');


    for(var i = 0; i < grade_edit.length; i++){
        if ( !$(grade_edit[i]).val() ) {
            continue;
        } else {
            editGrade($(grade_edit[i]).val(), $(gradeId[i]).text());
        }
    }


};

//Ajax call to retrieve the grades and the student ID and send them to the controller
//in order to save it to the DB

$("document").ready(function(){
    $("#form_edit").submit(function(e) {
        e.preventDefault();
        buttonClicked_edit();
        $.ajax({
            type: "POST",
            url: Routing.generate('ms_teacher_edit_grade'),
            data: {"allGrades_edit" :  allGrades_edit},
            async: true,

            success: function (data) {
                // console.log("its working");
                // function alert() {
                //     window.location.reload();
                    $('.result_edit').append('<h3 class="alert alert-info" role="alert">' + data.output + '<h3>');
                // }
                // setTimeout(alert);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        })
    });
});

