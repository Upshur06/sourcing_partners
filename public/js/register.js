let registerForm = document.getElementById("registerForm");
let username = document.getElementById("username");
let email = document.getElementById('email');
let password = document.getElementById('password');
let confirmPassword = document.getElementById('confirm');

let usernameError = document.getElementById('usernameError');
let emailError = document.getElementById('emailError');
let passwordError = document.getElementById('passwordError');
let confirmError = document.getElementById('confirmError');

const registerFunc = (event) => {
    event.preventDefault();

    registerConstraint = {
        user: {
            presence: {
                allowEmpty: false,
                message: "is required Please"
            },
            format: {
                pattern: "[A-Za-z0-9]+",
                flags: "i",
                message: "can only use characters a-z and 0-9"
            }
        },
        email: {
            presence: {
                allowEmpty: false,
                message: "is required Please"
            },
            email: {
                message: "has to be a valid email"
            },
        },
        password: {
            presence: {
                allowEmpty: false,
                message: "is required Please"
            },
            length: {
                minimum: 7,
                tooShort: 'needs to have %{count} characters or more'
            }
        },
        confirm: {
            presence: {
                allowEmpty: false,
                message: "is required Please"
            },
            length: {
                minimum: 7,
                tooShort: 'needs to have %{count} characters or more'
            }
        },
    };

        usernameError.innerHTML = "";
        emailError.innerHTML = "";
        passwordError.innerHTML = "";
        confirmError.innerHTML = "" ;

    registerUser = {
        user: username.value,
        email: email.value,
        password: password.value, 
        confirm: confirmPassword.value
    };

    let result = validate(registerUser, registerConstraint);

    fetch('/showregister', {
        method: "POST",
        body: JSON.stringify(registerUser),
    })
    .then((res)=> res.json())
    .then((data) => {        
        if(!result){
            window.location.href = '/user';  
        }else{                    
            if(result.user !== undefined){
                usernameError.innerHTML = result.user;
            }
            if(result.email !== undefined){
                emailError.innerHTML = result.email;
            }
            if(result.password !== undefined){
                passwordError.innerHTML = result.password;
            }
            if(result.confirm !== undefined){
                confirmError.innerHTML = result.confirm;
            }    
        }    
    })
    .catch(err=> console.log(err))
}

