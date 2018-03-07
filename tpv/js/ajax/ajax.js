/*global $*/
function pedirUser(){
        $.ajax({
            url : 'index.php',
            data: {
                ruta : 'product',
                accion : '',
            },
            dataType : 'json'
        }).done(function(msg){
            currentUser = msg;
            $('#name').text(currentUser.nick);
            $('#depart').text(currentUser.department);
        })
    }