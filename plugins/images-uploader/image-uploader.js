var addButton    = document.getElementById('add-btn');
var removeButton = document.getElementById('remove-btn');
var images       = document.getElementById('images');
var hidden       = document.getElementById('custom_image_data');

jQuery(document).ready( function($){ 

     var customUploader = wp.media(
       {
           title  : 'select images',
           button : {
               text : 'use this image'
           },
           multiple: true
       }
     );

     addButton.addEventListener('click', function(){
           if(customUploader){
             customUploader.open();
           }
     });

     customUploader.on('select', function(){
           var attachment = customUploader.state().get('selection').toJSON();
           let images = [];
           for(x = 0; x < attachment.length; x++){
             var elem = document.createElement("img");
             elem.setAttribute("src", attachment[x].url);
             images [x] = {id : attachment[x].id, url : attachment[x].url};
             document.getElementById("images-container").appendChild(elem);
           }
           images = JSON.stringify(images);
           hidden.setAttribute( 'value', images );
     });
     console.log(customUploads);

});