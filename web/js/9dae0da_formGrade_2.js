var result = [];

var addItem = function (grade,coef) {
    var resutlItem = {
        grade: grade,
        coef: coef
    };
    result.push(resutlItem);
};


var count = function () {
    var finalResult = 0;
    var average = 0;
    var totalCoef = $('.final_coef').text();
    $('.result').empty();

    for (var i = 0; i < result.length; i++) {
        var multiply = result[i].grade * result[i].coef;
        finalResult += multiply;
    }

    average = finalResult / totalCoef;

    if (average < 10){
    $('.result').append("Votre moyenne est de " +  average.toFixed(2) + " Vous êtes en rattrapage " );
    } else {
        $('.result').append("Votre moyenne est de " +  average.toFixed(2) + " Vous passez en classe supérieure " );
    }
};


$('#button').on('click', function () {
    var grade = $('.grade');
    var coef = $('.coef');

    for(var i = 0; i < grade.length; i++){
        addItem($(grade[i]).val(), $(coef[i]).text());
    }
    count();
    result = [];
});


