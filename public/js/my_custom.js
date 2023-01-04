

// window.addEventListener('resize', function(event) {
//     console.log(
//         event
//     )
// }, true);
let main__category_div = document.querySelector('.main__category_div');
let new__announce_btn_div = document.querySelector('.new__announce_btn_div');
let new__announce_small_btn_icon_div = document.querySelector('.new__announce_small_btn_icon_div');
let new__announce_btn_text = document.querySelector('.new__announce_btn_text');

let main__search_large_icon = document.querySelector('.main__search_large_icon');
let main__search_small_icon = document.querySelector('.main__search_small_icon');

if( window.innerWidth >= 992 ) {
    new__announce_btn_text.style.display = 'block'
}
else if( window.innerWidth < 992 ) {
    new__announce_btn_text.style.display = 'none'
}

onresize = (event) => {
    
    if( window.innerWidth >= 992 ) {
        console.log('window size == ', window.innerWidth)
        new__announce_btn_text.style.display = 'block'
    }
    else if( window.innerWidth < 992 ) {
        new__announce_btn_text.style.display = 'none';
        console.log('window size == ', window.innerWidth )
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
var navbar = document.getElementById('navbar');

if( path_name.indexOf('announce') === 1 ) {
    navbar.style.display = 'none';
}else{
    navbar.style.display = 'block';
}


// PRUDUCT ABOUT TEXT ...more 
var p_text = document.getElementById('product-about-text');
var p_full_text = document.getElementById('product-about-full-text');

if( path_name.indexOf('product') === 1 ) {
    p_full_text.style.display = 'none';
    p_text.style.display = 'block';
    
    function showProductAboutText() {
        p_text.style.display = 'none';
        p_full_text.style.display = 'block';
    
        console.log(p_full_text)
    }
}

// PRODUCT SHOW BUTTON
aukcion_btn = document.getElementById('product__show_aukcion_btn');


 /* IF THE PRODUCT IS ACTIVE IN REALTIME ON THE AUKTION THEN ADD ANIMATION START */
// IS ACTIVE ICON
 var is_active_icon = document.getElementsByClassName('product__on_auktion_icon');
 var product_card = document.getElementsByClassName('product-card');
//  console.log('product_card - ', product_card[0].childNodes[0].childNodes[0].childNodes )
// console.log( 'WWWW - ', product_card[0].childNodes)

recursionRes(product_card);

function recursionRes(product_card) {
    for(var i=0; i < product_card.length; i++ ) {
        if( product_card[i].childElementCount > 1 ) {
            console.log( 'one - '+  product_card[i].childNodes.childElementCount );
            recursionRes( product_card[i].childNodes );
        } else {
            console.log( 'two - '+ product_card[i].childNodes.childElementCount )
        }
     }
}


 if( typeof Array && is_active_icon.length > 0 ) {
    for( var i=0; i <= is_active_icon.length; i++ ) 
    {
        if( is_active_icon[0].classList[i] !== undefined && is_active_icon[0].classList[i] !== null )
        {
            if( is_active_icon[0].classList[i] == 'active-aukcion' ) {
                is_active_icon[0].style.animation = 'box-shadow 1s linear infinite';
            // console.log('AAASSSS - '+i+' = ', is_active_icon[0].classList[i] )
            }
        }
    }
 }

//  IS ACTIVE BUTTON
 var is_active_btn = document.getElementsByClassName('aukcion__is_active_btn');
//  console.log('BBBSSSS - '+i+' = ', is_active_btn[0].classList )

 if( typeof Array && is_active_btn.length > 0 ) {
    if( is_active_btn[0].classList !== undefined && is_active_btn[0].classList !== null && is_active_btn[0].classList.length > 0 ) {
        for(var i=0; i <= is_active_btn[0].classList.length; i++ ) {
            if( is_active_btn[0].classList[i] !==  undefined && is_active_btn[0].classList[i] !== null ) {
                is_active_btn[0].style.animation = 'box-shadow 1s linear infinite';
            }
        }
    } 
 }
  /* IF THE PRODUCT IS ACTIVE IN REALTIME ON THE AUKTION THEN ADD ANIMATION END */




// function showSubCategoryElement() {
//     alert(222222)
// }
