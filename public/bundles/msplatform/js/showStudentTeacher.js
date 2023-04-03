//Changer le nom des search button


var course;
var subject;

$('.search-panel .subject').find('li').click(function(e) {
    e.preventDefault();
    var concept = $(this).text();
    var conceptId = $(this).attr('id');

    subject = $('.search-panel span.search_concept_subject');
    subject.text(concept);
    subject.attr("id",conceptId);

});

$('.search-panel .course').find('li').click(function(e) {
    e.preventDefault();
    var concept = $(this).text();
    var conceptId = $(this).attr('id');

    course = $('.search-panel span.search_concept_course');
    course.text(concept);
    course.attr("id",conceptId);
});

$(document).ready(function(e){
    $("#search").click(function(e) {
        console.log("click");
        e.preventDefault();
        var courseId = course.attr("id");
        var subjectId = subject.attr("id");
        console.log(courseId, subjectId);
        $.ajax({
            type: "POST",
            url: "http://localhost/Miage/web/app_dev.php/teacher",
                // Routing.generate('ms_teacher_homepage'),
            data: {"subjectId" :  subjectId, "courseId" :  courseId},
            async: true,

            success: function (data) {
                console.log("its working");
                // function alert() {
                //     window.location.reload();
                // $('.result_edit').append('<h3 class="alert alert-info" role="alert">' + data.output + '<h3>');
                // }
                // setTimeout(alert);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log("not working");
            }
        })
    });





});