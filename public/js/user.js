let registeredUser = document.getElementById('registeredUser');


fetch('/recentuser')
.then((res) => res.json())
.then((data) => {
    if(data){
        registeredUser.innerHTML = data['username'];
    }
})
.catch((err) => console.log(err));