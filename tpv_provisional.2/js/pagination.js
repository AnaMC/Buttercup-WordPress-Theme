function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var page = getParameterByName('page');

if(page == ''){
    page = 1;    
}

var pagina = document.querySelectorAll('li');
for(var i = 0; i < pagina.length; i++) {
    if(pagina[i].textContent == page){
        pagina[i].setAttribute('class','active');
    }
}


