function search(){
    const searchbar = document.getElementById('searchbar');
    const div = document.getElementById("result");
    div.innerHTML = "";
    const search = searchbar.value;
    if(search !== ""){
        const request = new XMLHttpRequest();
        request.open('GET', 'includes/search.php?search='+search);
        request.onreadystatechange = function (){
            if(request.readyState === 4){
                const res = request.responseText;
                if(res !== ""){
                    div.innerHTML =  res;

                }else{
                    const div = document.getElementById("result");
                    div.innerHTML = "<p class='text-center fs-3'>Aucun résultat</p>"
                }

            }
        };
        request.send();

    }
}