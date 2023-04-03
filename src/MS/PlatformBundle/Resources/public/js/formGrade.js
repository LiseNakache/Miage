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
    console.log(totalCoef);
    $('.result').empty();

    for (var i = 0; i < result.length; i++) {
        var multiply = result[i].grade * result[i].coef;
        finalResult += multiply;

    }
    console.log(finalResult);
    average = finalResult / totalCoef;
    console.log(average);

    if (average < 10){
        $('.result').append('<h3 class="col-md-offset-2 col-md-8 alert alert-info" role="alert">'+ "Votre moyenne est de " +  average.toFixed(2) + " Vous êtes en rattrapage "+ '</h3>' );
    } else if (average >= 10 && average <= 20 )  {
        $('.result').append('<h3 class="col-md-offset-2 col-md-8 alert alert-info" role="alert">'+"Votre moyenne est de " +  average.toFixed(2) + " Vous passez en classe supérieure "+ '</h3>'  );
    } else {
        $('.result').append('<h5 class="col-md-offset-2 col-md-8 alert alert-warning" role="alert">'+ "Veuillez entrer des notes entre 0 et 20"+ '</h5>' );
    }
};


$('#form_simulation').on('click', function () {
    var grade = $('.grade');
    var coef = $('.coef');


    for(var i = 0; i < grade.length; i++){
        addItem($(grade[i]).val(), $(coef[i]).text());
    }
    count();
    result = [];
});


