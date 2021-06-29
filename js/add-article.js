// $(document).ready(function(){	
// 	$("#article-form").submit(function(event){
// 		submitForm();
// 		return false;
// 	});
// });


$(function (){
    $("input#submit").click(function submitForm(){
        $.ajax({
           type: "POST",
           url: "add-article.php",
           cache:false,
           data: $('form#article-form').serialize(),
           success: function(response){
               $("#new-article").html(response)
               $("#modal-add-article").modal('hide');
           },
           error: function(){
               alert("Error");
           }

        });
    });
});
