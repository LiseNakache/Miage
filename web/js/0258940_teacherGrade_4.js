var allGrades = [];

var addGrade = function (grade,student) {
    var resutlItem = {
        grade: grade,
        student: student,
    };
    allGrades.push(resutlItem);
};

var buttonClicked = function () {
    var grade = $('.grade');
    var student = $('.student');


    for(var i = 0; i < grade.length; i++){
        addGrade($(grade[i]).val(), $(student[i]).text());
    }


};

//Ajax call to retrieve the grades and the student ID and send them to the controller
//in order to save it to the DB

$("document").ready(function(){
    $("form").submit(function(e) {
        var subject = $('.subject').text();
        e.preventDefault();
        buttonClicked();
        $.ajax({
            type: "POST",
            url: Routing.generate('ms_teacher_add_grades'),
            data: {"allGrades" : allGrades, "subjectId" : subject},
            async: true,

            success: function (data) {
                console.log("its working");
                $('.result').append('<h3 class="alert alert-info" role="alert">' + data.output + '<h3>');

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        })
    });
});

