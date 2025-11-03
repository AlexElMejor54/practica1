console.log("Cargando");
function buscar(){
    fetch("sw_index.php") 
        .then((response) => response.json())
        .catch((error) => console.error("Error:", error))
        .then(function(json){
            console.log("JSON", json)
            var select = document.getElementById("select");

            for(var i = 0; i<json.length;i++){
                var opt = document.createElement('option');
                opt.value = json[i]["key"];
                opt.innerHTML = json[i]["value"]
                select.appendChild(opt);
            }
            
    });

    console.log("Continua ejecución");
}