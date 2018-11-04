var allGrades = [];

var editGrade = function (grade,gradeId) {
    var resutlItem = {
        grade: grade,
        gradeId : gradeId,
    };
    allGrades.push(resutlItem);
};

var buttonClicked = function () {
    var grade = $('.grade');
    var gradeId = $('.grade_id');


    for(var i = 0; i < grade.length; i++){
        if ( !$(grade[i]).val() ) {
            continue;
        } else {
            editGrade($(grade[i]).val(), $(gradeId[i]).text());
        }
    }


};

//Ajax call to retrieve the grades and the student ID and send them to the controller
//in order to save it to the DB

$("document").ready(function(){
    $("form").submit(function(e) {
        e.preventDefault();
        buttonClicked();
        $.ajax({
            type: "POST",
            url: Routing.generate('ms_teacher_edit_grade'),
            data: {"allGrades" : allGrades},
            async: true,

            success: function (data) {
                // console.log("its working");
                function alert() {
                    window.location.reload();
                    $('.result').append('<h3 class="alert alert-info" role="alert">' + data.output + '<h3>');
                }
                setTimeout(alert);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        })
    });
});

