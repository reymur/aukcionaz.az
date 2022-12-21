

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

// "all__category_image_li-styles" hover styles
let all__category_image_li_styles = document.querySelector('.all__category_image_li-styles')
let all__category_image_div_styles = document.querySelector('.all__category_image-div-styles')
let all__category_image_li_text = document.querySelector('.all__category_image_li-text')

if( all__category_image_li_styles !== null )
{
    all__category_image_li_styles.onmouseover = function() {
        // console.log('AAAAA = ', all__category_image_li_styles )
        all__category_image_li_styles.style.cursor = 'pointer'
        all__category_image_div_styles.style.border = '1px solid #009512b8';
        all__category_image_div_styles.style.padding = '18px';
        all__category_image_li_text.style.color = '#009512';
    }
    all__category_image_li_styles.onmouseout = function() {
        all__category_image_li_styles.style
        all__category_image_div_styles.style.border = 'none';
        all__category_image_div_styles.style.padding = '19px';
        all__category_image_li_text.style.color = '#212c3a';
    }
}


// "category__child_image_li-styles" hover styles 
let category_child_div = document.getElementById('category__child_div')
let category__child_image_li_styles = document.querySelector('.category__child_image_li-styles')
let category__child_image_div_styles = document.querySelector('.category__child_image-div-styles')
let category__child_image_a = document.querySelector('.category__child_image_a')

addBorderOnCategoryImageA = event => {
    event.target.children[1].style.color = '#009512b8';
    event.target.children[0].style.padding = '11px';
    event.target.children[0].style.border = '1px solid #009512b8';
    console.log( 'this = ', event.target.children[1]  )
}
rmBorderOnCategoryImageA = event => {
    event.target.children[0].style.border = 'none'
    event.target.children[0].style.padding = '12px'
    event.target.children[1].style.color = 'rgb(33, 44, 58)'
}

// DONT SHOW "NAVBAR" 
var path_name = document.location.pathname;

if( path_name.indexOf('announce/') === 1 ) {
    var navbar = document.getElementById('navbar');
    navbar.style.display = 'none';
}



var p_text = document.getElementById('product-about-text');
var p_full_text = document.getElementById('product-about-full-text');

p_full_text.style.display = 'none';
p_text.style.display = 'block';

function showProductAboutText() {
    p_text.style.display = 'none';
    p_full_text.style.display = 'block';

    console.log(p_full_text)
}





