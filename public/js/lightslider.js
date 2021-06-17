const slide=document.querySelectorAll('.li-slider');
const slider=document.querySelector(".content-slider ul");
const contSliders=document.querySelectorAll(".content-slider");
const sliders=document.querySelectorAll(".content-slider ul");
const flechas=document.querySelectorAll(".cont-flechas img");

slide.forEach(ele=>{
    ele.style.height=ele.clientWidth+"px";
})

window.onresize=()=>{
    slide.forEach(ele=>{
        ele.style.height=ele.clientWidth+"px";
    })
}

for (let i = 0; i < sliders.length; i++) {
    const element = sliders[i];

    let margenSlider=0;

    const moverSlide=(pos)=>{
        if(pos===1){
            if(margenSlider!==100){
                margenSlider+=50;
            }
        }

        if(pos===0){
            if(margenSlider!==0){
                margenSlider-=50;
            }
        }
        console.log(margenSlider)
        if(margenSlider==50){console.log("a")
            element.querySelectorAll(".li-slider")[2].classList.remove("slide-ocultar");
        }
        if(margenSlider==0){console.log("b")
            element.querySelectorAll(".li-slider")[3].classList.remove("slide-ocultar");
        }

        if(margenSlider===100){
            contSliders[i].querySelectorAll(".arrow")[1].style.display="none";
            contSliders[i].querySelector(".cont-flechas").style.width="50%";
        }else{
            contSliders[i].querySelector(".cont-flechas").style.width="100%";
            contSliders[i].querySelectorAll(".arrow")[1].style.display="block";
        }
        if(margenSlider===0){
            contSliders[i].querySelectorAll(".arrow")[0].style.display="none";

        }else{
            contSliders[i].querySelectorAll(".arrow")[0].style.display="block";
        }

        element.style.marginLeft='-'+margenSlider+'%';
    }

    const left=contSliders[i].querySelectorAll("span")[0];
    left.onclick=()=>moverSlide(0);
    const right=contSliders[i].querySelectorAll("span")[1];
    right.onclick=()=>moverSlide(1);
}
