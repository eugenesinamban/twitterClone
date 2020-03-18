'use strict';

document.addEventListener('DOMContentLoaded', function () {
  console.log('Hello Bulma!');
});

$('#login').click(function () {
  $('#modal-login').addClass('is-active');
});

$('#signUp').click(function () {
  $('#modal-signUp').addClass('is-active');
});

$('.modal-background').click(function () {
  $('#modal-login').removeClass('is-active');
  $('#modal-signUp').removeClass('is-active');
});