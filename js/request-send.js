

function formJSSend(student_form) {
    
    const request = new XMLHttpRequest()
    request.open('POST', 'server.php', true)
    request.setRequestHeader('Content-Type', 'application/json; charset=utf-8')

    const formData = new FormData(student_form)

    const data_obj = {}

    formData.forEach((value, key) => {
        data_obj[key] = value
    })

    const data = JSON.stringify(data_obj)

    request.send(data)
    document.querySelector("#table").innerHTML = "";
    request.addEventListener('load', () => {
        
        if (request.status === 200) {
            
        var res_data = request.response
         
        document.querySelector("#table").innerHTML += res_data;
            
      
        } 
    })
   
}

export { formJSSend }
