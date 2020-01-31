document.addEventListener('DOMContentLoaded', () => {
  console.log('Hello Bulma!');
});

var login = document.getElementById('login');
var signUp = document.getElementById('signUp');
var modalLogin = document.getElementById('modal-login');
var modalSignUp = document.getElementById('modal-signUp');
var modalBackground0 = document.getElementsByClassName('modal-background')[0];
var modalBackground1 = document.getElementsByClassName('modal-background')[1];

login.onclick = function() {
  console.log('test');
  modalLogin.classList.add('is-active');
}

modalBackground0.onclick = function() {
  console.log('test');
  modalLogin.classList.remove('is-active');
}

signUp.onclick = function() {
  console.log('test');
  modalSignUp.classList.add('is-active');
}

modalBackground1.onclick = function() {
  console.log('test');
  modalSignUp.classList.remove('is-active');
}

// window.onclick = function(event) {
//   this.console.log(event);
// }