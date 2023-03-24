function loadPage() {
    console.log("wd");
    document.getElementById('groupError').style.visibility = 'hidden';
    

    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + "userId".replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));

      
    if (matches !== null) {
        
        window.location.href = "/schedule.php";
    }
}

function setErrorForTextFields(fieldName, element) {
    let errText = 'Поле ' + fieldName + ' должно быть заполнено! ';
    let text = document.createTextNode(errText);
    element.appendChild(text);
    element.appendChild(document.createElement('br'));
}


function validateForm() {
    let isValidate = true;
    let errordiv = document.getElementById("groupError");
    errordiv.innerHTML = "";

    let groupId = document.forms["registerForm"]["group"].value; 
    let name = document.forms["registerForm"]["name"].value;
    let surname = document.forms["registerForm"]["surname"].value;
    let patr = document.forms["registerForm"]["patronymic"].value;
    let login = document.forms["registerForm"]["login"].value;
    let pass = document.forms["registerForm"]["pass"].value;

    if (groupId == 940)
    {
        errordiv.style.visibility = 'visible';
        const text = document.createTextNode('Ты не имеешь права тут учиться!\n');
        errordiv.appendChild(text);
        isValidate = false;
    }

    if (!parseInt(groupId) || groupId < 0) {
        errordiv.style.visibility = 'visible';
        const text = document.createTextNode('Значение поля "Группа" должно быть положительным целым числом!\n');
        errordiv.appendChild(text);
        isValidate = false;
    } 

    if (name === '') {
        errordiv.style.visibility = 'visible';
        setErrorForTextFields("Имя", errordiv);        
        isValidate = false;
    }

    if (surname === '') {
        errordiv.style.visibility = 'visible';
        setErrorForTextFields("Фамилия", errordiv);        
        isValidate = false;
    }

    if (patr === '') {
        errordiv.style.visibility = 'visible';
        setErrorForTextFields("Отчество", errordiv);        
        isValidate = false;
    }

    if (login === '') {
        errordiv.style.visibility = 'visible';
        setErrorForTextFields("Логин", errordiv);        
        isValidate = false;
    }

    if (pass === '') {
        errordiv.style.visibility = 'visible';
        setErrorForTextFields("Пароль", errordiv);        
        isValidate = false;
    }
    
    return isValidate;
}