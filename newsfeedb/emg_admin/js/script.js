 function note(){document.getElementById('small_note').innerHTML="<small>This New Category will be used for this post!</small>";}
 function preview() {
     //document.getElementById('load_image').innerHTML="Loading Image....";
     $("#fileUpload").on('change', function () {

         if (typeof (FileReader) != "undefined") {

             var image_holder = $("#profile_pic");
             image_holder.empty();

             var reader = new FileReader();
             reader.onload = function (e) {
                 $("<img/>", {
                     "src": e.target.result,
                     "class": "thumb-image"
                 }).appendTo(image_holder);

             }
             image_holder.show();
             reader.readAsDataURL($(this)[0].files[0]);
         } else {
             alert("This browser does not support FileReader.");
         }
     });
 }
 function disable () {
     var cat = document.getElementById('cat').value;
     if(cat !== "--Choose category--"){
         document.getElementById('new').disabled = true;
     }else{
         document.getElementById('new').disabled = false;
     }
 }

 
 function tag_disable ()
 {
     document.getElementById('new_tag').disabled = true;
 }