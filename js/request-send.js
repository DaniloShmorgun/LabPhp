

function openPopup(element){
    document.querySelector(element).style.left = '100px'}

function closePopup(element){
   document.querySelector(element).style.left = '-9999px'
}


function formJSSend(student_form) {
    
    const dataServer = document.createElement('p')
    const serverStatus = document.createElement('p')
    dataServer.classList.add('dataServer')
    serverStatus.classList.add('serverStatus')
    document.querySelector('.response-content').append(dataServer)
    document.querySelector('.response-content').append(serverStatus)

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

    request.addEventListener('load', () => {
if (request.status === 200) {
            
        var res_data = request.response
         dataServer.innerHTML = res_data
        
            serverStatus.textContent = request.statusText
            form.reset()
            setTimeout(() => {
                closePopup('#response-popup')
                setTimeout(() => {
                    dataServer.innerHTML = ''
                    serverStatus.textContent = ''
                }, 1000)
            }, 10000)
        } else {
            dataServer.innerHTML = 'Fail'
        }
    })
   
}

export { formJSSend,openPopup,closePopup}
