var allGrades = [];

var addGrade = function (grade,student) {
    console.log(grade,student);
    var resutlItem = {
        grade: grade,
        student: student,
    };

    allGrades.push(resutlItem);
    console.log(allGrades);
};

var buttonClicked_add = function () {
    var grade = $('.grade');
    var student = $('.student');

    for(var i = 0; i < grade.length; i++){
        addGrade($(grade[i]).val(), $(student[i]).text());
    }


};

//Ajax call to retrieve the grades and the student ID and send them to the controller
//in order to save it to the DB

$("document").ready(function(){
    $("#form_add").submit(function(e) {
        var subject = $('.subject').text();
        e.preventDefault();
        buttonClicked_add();
        $.ajax({
            type: "POST",
            url: "http://localhost/Miage/web/app_dev.php/teacher/add",
                // Routing.generate('ms_teacher_add_grades'),

            data: {"allGrades" : allGrades, "subjectId" : subject},
            async: true,

            success: function (data) {
                console.log("its working");
                $('.result_add').append('<h3 class="alert alert-info" role="alert">' + data.output + '<h3>');

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        })
    });
});

