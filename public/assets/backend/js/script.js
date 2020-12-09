(function () {
    
    //coleccion de elementos cuya clase es enlaceBorrar
    let enlacesBorrar = document.getElementsByClassName('enlaceBorrar');
    
    for(var i = 0; i < enlacesBorrar.length; i++) {
        enlacesBorrar[i].addEventListener('click', getClassConfirmation);
    }
    
    function getClassConfirmation(event) {
        let id = event.target.dataset.id; // data-id
        let titulo = event.target.dataset.name; //data-name
        let retVal = confirm('¿Estás seguro que quieres borrar ' + titulo + ' with id ' + id + '?');
        if(retVal) {
            var formDelete = document.getElementById('formDelete');
            formDelete.action += '/' + id;
            formDelete.submit();
        }
    }
    
    let enlaceBorrar = document.getElementById('enlaceBorrar');
    
    if(enlaceBorrar) {
        enlaceBorrar.addEventListener('click', getConfirmation);
    }
  
    function getConfirmation() {
        let id = event.target.dataset.id; //data-id
        let titulo = event.target.dataset.name; //data-name
        let retVal = confirm('¿Estás seguro que quieres borrar ' + titulo + ' con id ' + id + '?');
        if(retVal) {
            var formDelete = document.getElementById('formDelete');
            formDelete.submit();
        }
    }


})();