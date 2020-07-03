$(document).ready(function () {
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML =
        `<div class="form-group row justify-content-center">
                  <div class="col-12">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text  font-weight-bold" style="border-radius:15px 0 0 15px">PILIH
                           </div>
                        </div>
                        <input id="attachment" type="file" class="form-control" name="attachment[]">
                     </div>
                  </div>
               </div>`; //New input field html 
    var x = 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
