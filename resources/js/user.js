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

$(()=>{
    try {
        document.getElementById('img').onchange = function (evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            if (!FileReader || !files || !files.length) {
                return;
            }
            // var fr = new FileReader();
            // fr.onload = function () {
            //     const c =  document.getElementById('canvas');
            //     const ctx = c.getContext('2d');
            //     const img = new Image();
            //     img.onload = function() {
            //         if(img.width < img.height) {
            //             c.height = img.width;
            //             c.width = img.width;
            //             ctx.drawImage(img, 0, (img.height/2)-(img.width/2), img.width, img.width, 0, 0, c.width, c.height);
                        
            //         } else if(img.width > img.height) {
            //             c.width = img.height;
            //             c.height = img.height;
            //             ctx.drawImage(img, (img.width/2)-(img.height/2), 0, img.height, img.height, 0, 0, c.height, c.height);
            //         }

            //         c.toBlob(function(blob) {
            //             new Compressor(blob, {
            //                 quality: 0,
            //                 success(result) {
            //                     result.name="image.jpg";
            //                     document.getElementById("preview").src = URL.createObjectURL(result);
            //                     const formData = new FormData();
            
            //                     // The third parameter is required for server
            //                     formData.append('img', result, result.name);
            
            //                     // Send the compressed image file to server with XMLHttpRequest.
            //                     axios.post('/profil/img', formData).then(r => {
            //                         console.log(r.data);
            //                     });
            //                 },
            //                 error(err) {
            //                   console.log(err.message);
            //                 },
            //             });
            //         })

            //     };
            //     img.src = fr.result;
            // }
            // fr.readAsDataURL(files[0]);

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