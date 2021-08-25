$(document).ready(function(){
    var div_box="<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);
    $('#load-screen').delay(700).fadeOut(500,function(){
        $(this).remove();
    });
    
    ClassicEditor.create(document.querySelector('#textbox'));

    $('#selectAllBoxes').click(function(){
        if(this.checked){
            $('.checkBoxes').each(function(){
               this.checked = true; 
            });
        }
        else{
            $('.checkBoxes').each(function(){
               this.checked = false; 
            });
        }
        
    });
    $(".delete_link").click(function(){
        var id =$(this).attr("rel");
        var delete_url="?delete="+ id;
        console.log(delete_url);
       $(".modal_delete_link").attr("href",delete_url);
        $("#myModal").modal('show');
   });
 
});
function loadUserOnline(){
    $.get("functions.php?onlineusers=result", function(data){
       $(".useronline").text(data); 
    });
}

setInterval(function(){
    loadUserOnline();
},500);

















