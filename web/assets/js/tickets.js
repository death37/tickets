<<<<<<< HEAD
 $(document).ready(function(){
    $('.materialboxed').materialbox();
    
    M.updateTextFields();

    $('select').formSelect();
  
    
  });
=======
$(document).ready(function () {
    $('.my-selector').collection({
        prototype_name: '{{ myForm.myCollection.vars.prototype.vars.name }}',
        allow_add: false,
        allow_remove: false,
        name_prefix:  '{{ myForm.myCollection.vars.full_name }}'
    });
});
    
>>>>>>> e1b8be5071813d76d7a8afa36f1b5b62bd38a609
