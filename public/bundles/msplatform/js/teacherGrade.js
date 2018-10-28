// const routes = require('../../web/js/fos_js_routes.json');
// import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
// // var Routing = require('../../web/assets/Routing.js');
//
// Routing.setRoutingData(routes);
// Routing.generate('rep_log_list');


var allGrades = [];

var addGrade = function (grade,student) {
    var resutlItem = {
        grade: grade,
        student: student
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

// var fetch = function () {
//     var cityValue = $('.get-city').val();
//
//     $.ajax({
//         method: "GET",
//         url: "http://api.openweathermap.org/data/2.5/weather?q=" + cityValue + "&APPID=d703871f861842b79c60988ccf3b17ec",
//
//         success: function (data) {
//             $('.get-city').val('')
//             console.log(data)
//             prepInfos(data)
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log(textStatus);
//         }
//     });
// };





//Ajax call to retrieve the grades and the student ID and send them to the controller
//in order to save it to the DB

$("document").ready(function(){
    $("form").submit(function(e) {
        console.log("click");
        e.preventDefault();
        buttonClicked();
        // var formData = JSON.stringify(allGrades);
        console.log(allGrades["resultItem"]);
        $.ajax({
            method: "POST",
            url: Routing.generate('ms_teacher_add_grades'),
            data: formData,


            success: function (data) {
                console.log("its working");
                console.log(data);
                // $.each(data, function(key, value){
                //     $('.result').append('<option value="'+ key +'">'+ value +'</option>');
                // })
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
            }
        })
    //         .done(function(data) {
    //             if (data.success === true) {
    //                 window.location.href = data.url;
    //                 alert("its working")
    //             }
    //         })
    //         .fail(function(data) {
    //             alert('error');
    //         });
    //         // .always(function(data) {
    //         //
    //         // });
    //     return false;
    });
});

