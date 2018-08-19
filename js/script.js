


   //Byter från login till registreringsformulär  (jQuery)
    $('#account').on('click', function() {
        $('#login').addClass('hide');
        $('#login').removeClass('show');
        $('#register').addClass('show');
        $('#register').removeClass('hide');
        $('.content').addClass('high');
    });
    
    //Byter från registrerings till loginformulär  (jQuery)
    $('#back').on('click', function() {
        $('#login').addClass('show');
        $('#login').removeClass('hide');
        $('#register').addClass('hide');
        $('#register').removeClass('show');
        $('.content').removeClass('high');

    });

 

/**** Validerar formulär ****/

//Meddelanden i DOM
var messageCorrect = document.querySelector("#msg_true");
var messageFail = document.querySelector("#msg_fail");

// Popoupfönster i DOM
var popup = document.getElementById('popup');
//The span as close button
var popup_close = document.querySelector("span.close");


//Meddelande till användaren i popupfönstret
var message_fail = "";
var message_correct = "";
var success = false;



function validate() {

    
    //Valideringsfunktioner
    success = validateName();
    success = validatePassword();
    success = checkPassword();
    success = verifyAgreement();


    //Om validering lyckas, returnera true - annars visa meddelande i popupfönster
    if(success) {
        //Returnera true så att php-funktion kan köras efter lyckad validering
         return true;
    }
    else
    {
        //Visa meddelande i popupfönstret
        popup.style.display = "block";
        messageCorrect.innerHTML = message_correct;
        messageFail.innerHTML = message_fail;

        //Färger för felmeddelande
        messageCorrect.style.color = "#55c57a";
        messageFail.style.color = "#c55955";
        return false;
    }
}

//Händelsehanterare för stängknappen i popupfönstret
popup_close.addEventListener("click", function () {
    popup.style.display = "none";
    message_correct = "";
    message_fail ="";

}); 


//Händelsehanterare (stäng ner popup) om användaren klickar utanför fönstret
window.addEventListener("click", function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
        message_correct = "";
        message_fail ="";
    }
});


//Kollar om användarnamnen är mer än 6 tecken
function validateName() {
    //Hämtar värde från DOM
    var str_name = document.querySelector("#new_username").value;

    //Verifierar att värdet inte är null och mindre än 6 tecken - meddelande sätts.
    if(str_name=="" || str_name==null) {
        message_fail +=  "Du måste ange ett användarnamn" + "<br>";
    } else if (str_name.length < 6) {
        message_fail += "Användarnamnet måste vara längre än sex tecken" + "<br>";
    } else {
        message_correct += "Godkänt användarnamn" + "<br>";
        return true;
    }

}

//Kollar om lösenordet är mer än 6 tecken
function validatePassword() {
    //Hämtar värde från DOM
    var str_pw = document.querySelector("#new_password").value;

    //Verifierar att värdet inte är null och mindre än 6 tecken - meddelande sätts.
    if (str_pw == "" || str_pw == null) {
        message_fail += "Du måste ange ett lösenord" + "<br>";
    }
    else if (str_pw.length < 6) {
        message_fail += "Lösenordet måste vara längre än sex tecken" + "<br>";
    } else {
        message_correct += "Godkänt lösenord" + "<br>";
        return true;
    }
}

//ollar om lösenorden matchar
function checkPassword() {
    
    //Hämtar värden från DOM
    var str_pw = document.querySelector("#new_password").value;
    var str_pw2 = document.querySelector("#password_retype").value;

    //Verifierar att värdet inte är null och att strängarna matchas - meddelande sätts.
    if (str_pw2 == "" || str_pw2 == null) {
        message_fail += "Du måste verifiera lösenordet" + "<br>";
    }
    else if (str_pw!==str_pw2) {
        message_fail += "Löseorden matchar inte" + "<br>";
    } else {
        message_correct += "Lösenorden matchar" + "<br>";
        return true;
    }

}

//Kollar om checkboxen är ikryssad
function verifyAgreement() {
    //Hämtar värde från DOM
    var verify = document.querySelector("#checkbox");

    //Verifierar att värdet är true - meddelande sätts.
    if(verify.checked==true) {
        message_correct += "Du har godkänt användarvillkoren" + "<br>";
        return true;
    } else {
        message_fail += "Du måste godkänna användarvillkoren" + "<br>";
    }
}










