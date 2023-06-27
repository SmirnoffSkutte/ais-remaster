let user_info=JSON.parse(localStorage.getItem('user'))
let username=user_info.username

document.getElementById("nav-bar-user-name").innerHTML=username
