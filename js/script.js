window.addEventListener('load',()=>{
    document.querySelector('.all-content').style.display = 'block';
    document.body.style.height = "";
    document.querySelector('.page-loader').style.display = 'none';
})
window.addEventListener('scroll',()=>{
    const scroll = window.scrollY;
    var btn = document.getElementById('btn-gotop');

    if(scroll > 10.0)
        btn.style.display = 'block';
    else
        btn.style.display = 'none';

})
function show_Menu(){
    var menu = document.getElementById('menu_ul');
    menu.style.display = 'block';
}
function go_top(){
    window.scrollTo(0,0);
}

// function loadImg(){
//     document.querySelector('.img-loader-box').style.display = 'none';
// }

document.querySelectorAll('.img').forEach((item)=>{
    const imgId = (item.dataset.id);
    document.querySelector(`.js-img-${imgId}`).addEventListener('load',()=>{
        document.querySelector(`.js-img-loader-${imgId}`).style.display = 'none';
    })
})
