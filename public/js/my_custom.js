

// window.addEventListener('resize', function(event) {
//     console.log(
//         event
//     )
// }, true);
let main__category_div = document.querySelector('.main__category_div')
let new__announce_btn_div = document.querySelector('.new__announce_btn_div')
let new__announce_small_btn_icon_div = document.querySelector('.new__announce_small_btn_icon_div')
let new__announce_btn_text = document.querySelector('.new__announce_btn_text')

let main__search_large_icon = document.querySelector('.main__search_large_icon')
let main__search_small_icon = document.querySelector('.main__search_small_icon')

if( window.innerWidth >= 992 ) {
    new__announce_btn_text.style.display = 'block'
}
else {
    new__announce_btn_text.style.display = 'none'
}

onresize = (event) => {
    
    if( window.innerWidth >= 992 ) {
        // console.log('main__category_div == ', main__category_div.classList)
        new__announce_btn_text.style.display = 'block'
    }
    else {
        new__announce_btn_text.style.display = 'none'
    }
};






