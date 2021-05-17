
function delete_table() {
    
    const request = new XMLHttpRequest()
    document.querySelector("#table").innerHTML = "";
    request.open('POST', 'server.php', true)
    request.setRequestHeader('Content-Type', 'application/json; charset=utf-8')

    request.send("{ \"delete_table\" : \"true\"}")
    request.addEventListener('load', () => {
        
        if (request.status === 200) {
            document.querySelector("#table").innerHTML = "";
            alert("Table was deleted");
        } 
    })
   
}