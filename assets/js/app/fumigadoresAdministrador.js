$(document).ready( ()=>{
    console.log("Hola Mundo");
    $("#btnNuevo").on("click", function(){
        console.log("Button clicked!");
        $('#modalCRUD').modal('show');
    });
    // Add an event listener to the image
$('#image').on('click', function(event) {
    event.stopPropagation();
    // Create a new image element with the same source
    const enlargedImage = $('<img>').attr('src', $(this).attr('src'));
  
    // Add the enlarged image to the container
    $('#enlarged-image').html(enlargedImage);
  
    // Show the enlarged image container
    $('#enlarged-image').fadeIn();
  
    // Add an event listener to the enlarged image container to close it when clicked
    $('#enlarged-image').on('click', function() {
      $(this).fadeOut();
    });
  
    // Add an event listener to the body to close the enlarged image container when clicked outside
    $('body').on('click', function(event) {
      if ($(event.target).closest('#enlarged-image').length === 0) {
        $('#enlarged-image').fadeOut();
      }
    });
  });
})