const check=document.querySelector("#defaultCheck2");
const btnForm=document.querySelector(".btn-form");


check.onclick=()=>{

    if(check.checked){
        btnForm.disabled=false;
        console.log("a")
    }else{
        btnForm.disabled=true;
        console.log("b")

    }
}
