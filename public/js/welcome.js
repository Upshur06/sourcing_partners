let logginUser = document.getElementById('logginUser');
let logout = document.getElementById("logout");
let loggedUser = localStorage.getItem('username');

// console.log('user: ' + loggedUser);
logginUser.innerHTML = loggedUser;

logout.addEventListener("click", ()=>{
    localStorage.clear();
});