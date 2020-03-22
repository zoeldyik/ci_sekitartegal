$(document).ready(function () {
    //Get CurrentUrl variable by combining origin with pathname, this ensures that any url appendings (e.g. ?RecordId=100) are removed from the URL
    var CurrentUrl = window.location.origin + window.location.pathname;
    //Check which menu item is 'active' and adjust apply 'active' class so the item gets highlighted in the menu
    //Loop over each <a> element of the NavMenu container
    $('#nav-kategori a').each(function (Key, Value) {

        Value.removeClass('active');

        //Check if the current url
        if (Value['href'] === CurrentUrl) {
            //We have a match, add the 'active' class to the parent item (li element).
            $(Value).addClass('active');
        }
    });
});




const sweetalertData = document.querySelector('.sweetalert-box').dataset.target;


if (sweetalertData) {
    Swal.fire({
        icon: 'success',
        title: sweetalertData,
        confirmButtonColor: '#0f7864'
    })
}




