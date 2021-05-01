let numAlergenos=document.querySelectorAll(".numAlergenos"),
      checkAlergeno=document.querySelectorAll(".checkAlergeno"),
      formPlato=document.querySelectorAll(".formPlato");

const arrAlergenos={};

formPlato.forEach((form,i)=>{
   arrAlergenos['pos'+i]=[];

    for (let index = i*14; index < i*14+14; index++) {
       const indice=form.querySelector(".checkAlergeno").getAttribute("data-id");
        checkAlergeno[index].onchange=()=>{
            if(checkAlergeno[index].checked){
                arrAlergenos[indice]=[(index-14*i)+1,...arrAlergenos[indice]];
                numAlergenos[i].value=JSON.stringify(arrAlergenos[indice]);
            }else{
                arrAlergenos[indice]=JSON.parse(numAlergenos[i].value).filter(num=>{
                    if(num==(index-14*i)+1) return null;
                    else return num;
                });
                numAlergenos[i].value=JSON.stringify([...arrAlergenos[indice]]);
            }
        };
    }
});

function cambiarStatus(url,id){
    const resp=fetch(url,{
        headers:{
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method:'POST'
    }).then(function(response) {
        if(response.ok) {
            return response.json();
        } else {
            throw "Error en la llamada Ajax";
        }
    })
    .then(function(resp) {
        const selector=`.p${id}`;
        const p=document.querySelector(selector);
        if(resp.status===1){
            p.innerHTML="Habilitado";
            p.classList.remove("text-danger");
            p.classList.add("text-success");
        }else{
            p.innerHTML="Inhabilitado";
            p.classList.add("text-danger");
            p.classList.remove("text-success");
        }
    })
    .catch(function(err) {
        console.log(err);
    });
}

document.querySelector(".editarCategoria").onclick=()=>{
    const arrCategorias=[];
    const categoriasEdit=document.querySelectorAll(".categoriasEdit");

    categoriasEdit.forEach(categoria=>{
        arrCategorias.push(categoria.value);
    });

    document.querySelector(".categoriasJson").value=JSON.stringify(arrCategorias);
    document.querySelector("#editForm").submit();
}

let activa=0;
function pestanaActiva(id=0){
    activa=id;
    if(id===999){
        activa=document.querySelectorAll(".imagenClass").length - 1;
        console.log(activa)
    }
}

$(document).ready(function() {
    // Escucha el evento que surge cuando el source de la imagen cambia:
    let img = document.querySelector("#imagen_final"),
       observer = new MutationObserver((changes) => {
         changes.forEach(change => {
             if(change.attributeName.includes('src')){console.log(document.querySelectorAll('.imagenClass')[activa])
               document.querySelectorAll('.imagenClass')[activa].value = img.src;
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
               aspectRatio: 1,
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
              width: 800,
              height: 800
           });

           canvas.toBlob(function(blob) {
              url = URL.createObjectURL(blob);
              var reader = new FileReader();
              reader.readAsDataURL(blob);
              reader.onloadend = function() {
                 var base64data = reader.result;
                 document.querySelectorAll('.imagen_final')[activa].src = base64data;
                 document.querySelector("#imagen_final").src = base64data;
                 bs_modal.modal('hide');
              };
           });
        });
