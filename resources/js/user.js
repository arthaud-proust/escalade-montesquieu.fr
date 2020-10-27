// import Compressor from 'compressorjs';
const Compressor = require('compressorjs')
const cotes = ['Non renseigné', '4a','4b','4c','5a','5b','5c','6a','6b','6c','7a','7b','7c','8a','8b','8c'];
const roles = [ ['Grimpeur', 'climber'], ['Modérateur', 'modo'], ['Admin', 'admin'] ];

function getShoesOption(shoe) {
    let content = `<option ${shoe=="no-need"?'selected':''} value="no-need">J'ai mes chaussures</option>`;
    for (let i=36; i<51; i++) {
        content+= `<option ${shoe==i?'selected':''} value="${i}">${i}</option>`;
    }
    return content
}

function resizedataURL(datas){
    return new Promise(async function(resolve,reject){

        // We create an image to receive the Data URI
        var img = document.createElement('img');

        // When the event "onload" is triggered we can resize the image.
        img.onload = function()
        {        
            // We create a canvas and get its context.
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            const h=this.height,
                  w=this.width; 

            // We resize the image with the canvas method drawImage();
            if(h > w ) {
                // height greater than width
                // we keep the width, crop in height
                canvas.width = canvas.height = w;
                ctx.drawImage(this, 0, (h/2)-(w/2), w, w, 0, 0, w, w);
            } else if (w > h) {
                // width greater than height
                // we keep the height, crop in width
                canvas.width = canvas.height = h;
                ctx.drawImage(this, (w/2)-(h/2), 0, h, h, 0, 0, h, h);
            } else {
                // width greater equal to height
                // nothing change
                canvas.width = canvas.height = w;
                ctx.drawImage(this, 0, 0, w, w);
            }

            // var dataURI = canvas.toDataURL();

            // This is the return of the Promise
            // resolve(dataURI);

            canvas.toBlob(function(blob) {
                resolve(blob);
            })
        };

        // We put the Data URI in the image's src attribute
        img.src = datas;

    })
}

$(()=>{
    try {
        document.getElementById('img').onchange = function (evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            if (!FileReader || !files || !files.length) {
                return;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log(e);
                resizedataURL(e.target.result).then(img=>{
                    new Compressor(img, {
                        quality: 0.4,
                        success(result) {
                            result.name="image.jpg";
                            document.getElementById("preview").src = URL.createObjectURL(result);
                            const formData = new FormData();
        
                            // The third parameter is required for server
                            formData.append('img', result, result.name);
        
                            // Send the compressed image file to server with XMLHttpRequest.
                            axios.post('/profil/img', formData).then(r => {
                                console.log(r.data);
                            });
                        },
                        error(err) {
                            console.log(err.message);
                        },
                    });
                })
            };
            reader.readAsDataURL(files[0]);

            return
            new Compressor(files[0], {
                quality: 0.4,
                success(result) {
                    result.name="image.jpg";
                    document.getElementById("preview").src = URL.createObjectURL(result);
                    const formData = new FormData();

                    // The third parameter is required for server
                    formData.append('img', result, result.name);

                    // Send the compressed image file to server with XMLHttpRequest.
                    axios.post('/profil/img', formData).then(r => {
                        console.log(r.data);
                    });
                },
                error(err) {
                    console.log(err.message);
                },
            });
        }
    } catch(e) {}
    

    
    try {
        // if($('#max_voie').html() == '' && $('#max_bloc').html() == '' &&) {}
        // cotes.map(cote=>{
        //     $('#max_voie').append(`<option ${$('#max_voie').attr('data-value')==cote?'selected':''}>${cote}</option>`);
        //     $('#max_bloc').append(`<option ${$('#max_bloc').attr('data-value')==cote?'selected':''}>${cote}</option>`);
        // });
        $('#max_voie').html(cotes.map(cote=>`<option ${$('#max_voie').attr('data-value')==cote?'selected':''}>${cote}</option>`));
        $('#max_bloc').html(cotes.map(cote=>`<option ${$('#max_bloc').attr('data-value')==cote?'selected':''}>${cote}</option>`));
        $('#shoes').html(getShoesOption($('#shoes').attr('data-value')));
    } catch(e) {}
        
    try{
        $('#role').html(roles[$('#role').attr('data-level')-1][0]);
        $('#role').attr('class', 'IdentityBloc-role '+roles[$('#role').attr('data-level')-1][1]);
    } catch(e) {}

});