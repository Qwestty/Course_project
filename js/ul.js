let blocks = document.querySelectorAll('.block');

blocks.forEach(block => {
    const liFaq = block.querySelector('.li_faq')
    const arrowIconFaq = block.querySelector('.arrow_icon-faq')
    block.addEventListener('click', function (){
        if (liFaq.classList.contains('show_text')){
            liFaq.classList.remove('show_text')
            liFaq.classList.add('hide_li')
            arrowIconFaq.classList.remove('round')
        }else{
            liFaq.classList.add('show_text')
            liFaq.classList.remove('hide_li')
            arrowIconFaq.classList.add('round')
        }
    })
});
