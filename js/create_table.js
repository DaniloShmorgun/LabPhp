function create_table(student_form) {
    
    const request = new XMLHttpRequest()
    request.open('POST', 'server.php', true)
    request.setRequestHeader('Content-Type', 'application/json; charset=utf-8')


    request.send("{ \"create_table\" : \"true\"}")
    document.querySelector("#table").innerHTML = "";
    request.addEventListener('load', () => {
        
        if (request.status === 200) {
            
        var res_data = request.response
         
        document.querySelector("#table").innerHTML += res_data;
            
      
        } 
    })
   
}
