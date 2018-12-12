$(document).ready(function () {
    $('.my-selector').collection({
        prototype_name: '{{ myForm.myCollection.vars.prototype.vars.name }}',
        allow_add: false,
        allow_remove: false,
        name_prefix:  '{{ myForm.myCollection.vars.full_name }}'
    });
});
    