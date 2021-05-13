

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
            
        var res_data = JSON.parse(request.response)
        //  dataServer.innerHTML = res_data.first_name +' '+  res_data.last_name +' '+  res_data.email +' '+  res_data.password +' '+  res_data.number
        dataServer.innerHTML = res_data.first_name +' '+  res_data.last_name 
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
    return data_obj
}



function formJQuerySend(form){
    const messages = {
        loading : "Loading...",
        success : "Success!",
        failure : "Failure!"
    }

    const dataServer = document.createElement('p')
    const serverStatus = document.createElement('p')
    dataServer.classList.add('dataServer')
    serverStatus.classList.add('serverStatus')
    document.querySelector('.response-content').append(dataServer)
    document.querySelector('.response-content').append(serverStatus)
    serverStatus.textContent = messages.loading


    const formData = new FormData(form)
    setTimeout(() => {
        console.log(formData)
    }, 3000)
    const data_obj = {}

    formData.forEach((value, key) =>{
        data_obj[key] = value
    })


    // name="first_name"   ></p>
    //   <p>Прізвище: <br><input type="lastName" placeholder="Прізвище" name="last_name" ></p>
    //   <p>Ваш емейл:<br> <input type="email" placeholder="Емейл" name="email" ></p>
    //   <p>Пароль:<br> <input type="password" placeholder="Пароль" name="password"></p>
    //   <p>Номер телефону:<br> <input type="tel" placeholder="Номер" name="number"
    $.ajax({
        url: 'server.php',
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data_obj),
        success: (data, textStatus) => {
            if (textStatus === 'success') {
                data = JSON.parse(data)
                dataServer.innerHTML = data.first_name +' '+  data.last_name +' '+  data.email +' '+  data.password +' '+  data.number
                serverStatus.textContent = messages.success
                form.reset()
                setTimeout(() => {
                    closePopup('#response-popup')
                    setTimeout(() => {
                        dataServer.innerHTML = ''
                        serverStatus.textContent = ''
                    }, 1000)
                }, 10000)
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.log(textStatus)
            console.log(errorThrown)
            dataServer.innerHTML = ''
            serverStatus.textContent = messages.failure
        }
    })
    return data_obj
}


export {formJSSend, formJQuerySend,openPopup,closePopup}
