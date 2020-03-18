document.addEventListener('DOMContentLoaded', () => {
  console.log('Hello Bulma!');
});

$('#login').click(() => {
  $('#modal-login').addClass('is-active');
});

$('#signUp').click(() => {
  $('#modal-signUp').addClass('is-active');
});

$('.modal-background').click(() => {
  $('#modal-login').removeClass('is-active');
  $('#modal-signUp').removeClass('is-active');
});

