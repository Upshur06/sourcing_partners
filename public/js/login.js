let username = document.getElementById('username'); 
let password = document.getElementById('password'); 

let usernameError = document.getElementById('usernameError');
let emailError = document.getElementById('emailError');

const loginFunc = (event) => {
    event.preventDefault();

    loginConstraints = {
        user: {
            presence: {
                allowEmpty: false,
                message: "is required"
            },
            format: {
                pattern: "[A-Za-z0-9]+",
                flag: "i",
                message: "can only use characters a-z and 0-9"
            }
        },
        password: {
            presence: {
                allowEmpty: false,
                message: 'is required'
            },
            length: {
                minimum: 7,
                tooShort: 'needs to have %{count} characters or more'
            }
        }
    }

    usernameError.innerHTML = "";
    passwordError.innerHTML = "";

    loginUser = {
        user: username.value,
        password: password.value
    }

    let result = validate(loginUser, loginConstraints);

    fetch('/userinfo')
    .then((res) =>res.json())
    .then((data) => {       
        let found = data.find(el => el['username'] == loginUser['user'] && el['password'] == loginUser['password']);        
        if(!result){    
            if(!found){
                // console.log('user password', password.value);
                alert('username or password does not match');
            }else{
                localStorage.setItem('username', username.value);
                window.location.href='/dashboard' 
            }
        }else{                    
            if(result.user !== undefined){
                usernameError.innerHTML = result.user;
            }
            if(result.password !== undefined){
                passwordError.innerHTML = result.password;
            }   
        }    
    })
    .catch((err) => console.log(err));
}