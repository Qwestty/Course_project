let element = document.querySelector('.header__navigation');
let upButton = document.querySelector('.up-button');
let phoneButton = document.querySelector('.navigation__phone');
let phoneNumber = document.querySelector('.phone-number');
let loginButton = document.querySelector('.login');
let headerContainer = document.querySelector('.header__container');
let descriptionText = document.querySelector('.description_text');
let descriptionTextSale = document.querySelector('.description_text-sale');
let descriptionTextNews = document.querySelector('.description_text-news');
let alertDismissible = document.querySelector('.alert-dismissible');
let exitIcon_us = document.querySelector('.exit_icon');
let exitIconTrainer = document.querySelector('.exit_icon_trainer');
let blockDescription = document.querySelector('.site_description');
let trainerDescription = document.querySelector('.trainer_description');
let aboutUs = document.querySelector('.about_us');
let aboutTrainer = document.querySelector('.about_trainer');
let exitIconTraining = document.querySelector('.exit_icon_training');
let aboutTraining = document.querySelector('.about_training');
let trainingDescription = document.querySelector('.training_description');
let blockDescription_p = document.querySelector('.block_description');

setTimeout(function(){
    alertDismissible.classList.add('hide_desc');
}, 2000);

aboutTraining.addEventListener('click', function (){
    if (trainingDescription.classList.contains('show_des')) {
        trainingDescription.classList.remove('show_des')
        trainingDescription.classList.add('hide_des')
    }else{
        trainingDescription.classList.add('show_des')
        trainingDescription.classList.remove(  'hide_des')
    }
});
exitIconTraining.addEventListener('click', function (){
    if (trainingDescription.classList.contains('show_des')) {
        trainingDescription.classList.remove('show_des')
        trainingDescription.classList.add('hide_des')
    }
});
aboutTrainer.addEventListener('click', function (){
    if (trainerDescription.classList.contains('show_des')) {
        trainerDescription.classList.remove('show_des')
        trainerDescription.classList.add('hide_des')
    }else{
        trainerDescription.classList.add('show_des')
        trainerDescription.classList.remove(  'hide_des')
    }
});
exitIconTrainer.addEventListener('click', function (){
    if (trainerDescription.classList.contains('show_des')) {
        trainerDescription.classList.remove('show_des')
        trainerDescription.classList.add('hide_des')
    }
});

aboutUs.addEventListener('click', function (){
    if (blockDescription.classList.contains('show_des')) {
        blockDescription.classList.remove('show_des')
        blockDescription.classList.add('hide_des')
    }else{
        blockDescription.classList.add('show_des')
        blockDescription.classList.remove(  'hide_des')
    }
});
exitIcon_us.addEventListener('click', function (){
    if (blockDescription.classList.contains('show_des')) {
        blockDescription.classList.remove('show_des')
        blockDescription.classList.add('hide_des')
    }
});


window.onscroll = function () {
    if (window.pageYOffset > 300) {
        upButton.classList.add('shown');
        headerContainer.classList.add('hide')
    }else {
        upButton.classList.remove('shown');
        headerContainer.classList.remove('hide')
    }
};

function fun1(){
    if (document.getElementById('contactChoice1').checked){
        descriptionText.classList.add('show_text')
        descriptionTextSale.classList.add('hide_text')
        descriptionTextNews.classList.add('hide_text')
        descriptionTextNews.classList.remove('show_text')
        descriptionTextSale.classList.remove('show_text')
    } else if (document.getElementById('contactChoice2').checked){
        descriptionTextSale.classList.add('show_text')
        descriptionText.classList.add('hide_text')
        descriptionTextNews.classList.add('hide_text')
        descriptionTextNews.classList.remove('show_text')
        descriptionText.classList.remove('show_text')
    } else if (document.getElementById('contactChoice3').checked){
        descriptionText.classList.add('hide_text')
        descriptionTextSale.classList.add('hide_text')
        descriptionTextNews.classList.add('show_text')
        descriptionTextSale.classList.remove('show_text')
        descriptionText.classList.remove('show_text')
    }
}

function scrollTo(element){
    window.scroll({
        left: 0,
        top: element.offsetTop,
        behavior: "smooth"
    })
}
upButton.addEventListener('click', () =>{
    scrollTo(element);
});
phoneButton.addEventListener('mouseover', function (){
    phoneNumber.classList.add('orange')
});
phoneButton.addEventListener('mouseout', function (){
    phoneNumber.classList.remove('orange')
});
loginButton.addEventListener('mouseover', function (){
    loginButton.classList.add('orange_back')
});
loginButton.addEventListener('mouseout', function (){
    loginButton.classList.remove('orange_back')
});

