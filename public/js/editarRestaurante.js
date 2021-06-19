let sec=document.querySelectorAll(".sec");
let titleSec=document.querySelectorAll(".scroll li");



titleSec.forEach((li,i)=>{
    li.onclick=()=>{
        sec.forEach(seccion=>seccion.classList.remove('sec_active'));
        sec[i].classList.add('sec_active');

        titleSec.forEach(seccion=>seccion.classList.remove('active'));
        titleSec[i].classList.add('active');
        titleSec[i].scrollIntoView(false);
    }
});

let arrImg=[];
let arrImgOri=[];
let valuesImg=document.querySelector(".valuesImg");
let img = document.querySelector("#imagen_final")
let coleccionImg=document.querySelector(".coleccionImg");
let coleccionImg2=document.querySelector(".coleccionImg2");
let aspectRatio=16/9;
let widthCanvas=1280;
let heightCanvas=720;

arrImgOri=JSON.parse(valuesImg.value);

function quitarImg(e){
    coleccionImg.removeChild(e);
    arrImg=arrImg.filter(comp=>comp!==e.src);
    document.querySelector('#imagen1').value = JSON.stringify(arrImg);
}

function quitarImgOri(e){
    coleccionImg.removeChild(e);
    arrImgOri=arrImgOri.filter(comp=>comp!==e.alt);
    valuesImg.value = JSON.stringify(arrImgOri);
}

document.querySelectorAll(".btn-file").forEach((btn,i)=>{
    btn.onclick=()=>{
        if(i===0){
            aspectRatio=16/9;
            widthCanvas=1280;
            heightCanvas=720;
        }else{
            aspectRatio=1;
            widthCanvas=100;
            heightCanvas=100;
        }
    }
})

$(document).ready(function() {

  $('#tabla_listado_restaurantes').DataTable();

  function agregarImg(){
    if(aspectRatio!==1){
        const imgDom=document.createElement("img");
        imgDom.setAttribute("src",img.src);
        imgDom.className="img-coleccion col-md-4 col-sm-6 img-fluid my-1";
        coleccionImg.appendChild(imgDom);
        arrImg.push(img.src);
        const urlImg=img.src;
        document.querySelector('#imagen1').value = JSON.stringify(arrImg);

        imgDom.onclick=(e)=>quitarImg(e.target);
    }else{
        const imgDom=document.createElement("img");
        imgDom.setAttribute("src",img.src);
        imgDom.className="img-coleccion col-md-4 col-sm-6 img-fluid my-1";
        coleccionImg2.innerHTML='';
        coleccionImg2.appendChild(imgDom);
        const urlImg=img.src;
        document.querySelector('#imagen2').value =urlImg;

        imgDom.onclick=(e)=>{
            coleccionImg2.removeChild(imgDom);
            document.querySelector('#imagen2').value ='';
        };
    }
  }

  // Escucha el evento que surge cuando el source de la imagen cambia:
  let observer = new MutationObserver((changes) => {
    changes.forEach(change => {
        if(change.attributeName.includes('src')){
            agregarImg();
        }
    });
  });
  observer.observe(img, {attributes : true});

});


// CROPPER
var bs_modal = $('#ventanaModal');
var image = document.getElementById('imagen_original_visualizada');
var cropper, reader, file;

$('body').on("change", "#original_image", function (e) {
    var files = e.target.files;
    var done = function(url){
        image.src = url;
        bs_modal.modal('show');
    };

    if (files && files.length > 0) {
        file = files[0];

        if (URL) {
        done(URL.createObjectURL(file));
        } else if(FileReader) {
        reader = new FileReader();
        reader.onload = function(e){
            done(reader.result);
        };
        reader.readAsDataURL(file);
        }
    }
});

bs_modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
        aspectRatio: aspectRatio,
        viewmode: 3,
        preview: ".preview_imagen_recortada",
    });
}).on('hidden.bs.modal', function() {
    document.getElementById("original_image").value = "";
    cropper.destroy();
    cropper = null;
});

$('#crop').click(function() {
    canvas = cropper.getCroppedCanvas({
        width:widthCanvas,
        height:heightCanvas
    })

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
        var base64data = reader.result;
        document.getElementById('imagen_final').src = base64data;
        bs_modal.modal('hide');
        };
    })
});

document.querySelector("#msform").onsubmit=e=>{
    e.preventDefault();

    if(document.querySelector("#nombre").value.trim()==''){
        alert("El nombre del restaurante es obligatorio");
    }else{
        if(document.querySelector("#ciudad").value.trim()==''){
            alert("La ciudad es obligatoria");
        }else{
            if(document.querySelector("#imagen1").value.trim()==''){
                alert("Debe agregar al menos una imágen del restaurante");
            }else{
                e.target.submit();
            }
        }
    }
}
