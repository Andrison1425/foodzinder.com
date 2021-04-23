let btnNext=document.querySelectorAll("[name=next]");
let btnBack=document.querySelectorAll("[name=back]");
let sec=document.querySelectorAll(".sec");
let titleSec=document.querySelectorAll(".scroll li");

btnNext.forEach((btn,i)=>{
    btn.onclick=()=>{
        sec.forEach(seccion=>seccion.classList.remove('sec_active'));
        sec[i+1].classList.add('sec_active');

        titleSec.forEach(seccion=>seccion.classList.remove('active'));
        titleSec[i+1].classList.add('active');
        titleSec[i+1].scrollIntoView();
    }
});

btnBack.forEach((btn,i)=>{
    btn.onclick=()=>{
        sec.forEach(seccion=>seccion.classList.remove('sec_active'));
        sec[i].classList.add('sec_active');

        titleSec.forEach(seccion=>seccion.classList.remove('active'));
        titleSec[i].classList.add('active');
        titleSec[i].scrollIntoView();
    }
});

$(document).ready(function() {
    let arrImg=[];
    let coleccionImg=document.querySelector(".coleccionImg");
  $('#tabla_listado_restaurantes').DataTable();

  // Escucha el evento que surge cuando el source de la imagen cambia:
  let img = document.querySelector("#imagen_final"),
  observer = new MutationObserver((changes) => {
    changes.forEach(change => {
        if(change.attributeName.includes('src')){
            const imgDom=document.createElement("img");
            imgDom.setAttribute("src",img.src);
            imgDom.className="img-coleccion col-md-4 col-sm-6 img-fluid my-1";
            coleccionImg.appendChild(imgDom);
            arrImg.push(img.src);
            const urlImg=img.src;
            document.querySelector('#imagen1').value = JSON.stringify(arrImg);
            console.log(document.querySelector('#imagen1').value)
          imgDom.onclick=()=>{
              coleccionImg.removeChild(imgDom);
              arrImg=arrImg.filter(ele=>ele!==urlImg);
              document.querySelector('#imagen1').value = JSON.stringify(arrImg);
          }
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
        aspectRatio: 16/9,
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
        width: 1280,
        height: 720
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
