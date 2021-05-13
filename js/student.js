function getOrSetValue(getOrSet, input) {

  const request = new XMLHttpRequest();

  request.open('POST', 'server.php');
  request.setRequestHeader('Content-type', 'application/json; charset = utf-8');

  const formData = new FormData(form);
  let user = {};
  
  formData.forEach((value,key) => {
     user[key] = value
  });
  
  user["getOrSet"] = getOrSet;
  user["target"] = input;
  let patern = /^[A-Z a-z А-Я а-я Ґ ґ І і Ї ї Є є]+$/;
  let paternGroup = /^([А-Я І A-Z]){2}-[0-9]{2}$/;
  let paternDate = /^(\d{2}-\d{2}-\d{4})$/;
  let correctPrompt;
  
  if(getOrSet === 'set'){
      
     if(input === 'date'){
        user["value"] = prompt("Уведіть нове значення дати народження у форматі: dd-mm-yyyy ");
        correctPrompt = paternDate.exec(user["value"]); 
     }
     else if(input === 'group'){
        user["value"] = prompt("Уведіть нове значення групи у форматі: ББ-ЧЧ (Б - велика буква, Ч - число) ");
        correctPrompt = paternGroup.exec(user["value"]); 
     }
     else{
        user["value"] = prompt("Уведіть нове значення");
        correctPrompt = patern.exec(user["value"]);
     }
  }
  
  if(correctPrompt === null){
     
     alert("Перевірте правильність введенних данних. Ім`я та прізвище треба вводити англійскою, або російкою, або українскою мовою ");

  }
  
  else{
      
   const json = JSON.stringify(user);
  
  request.send(json);

  request.addEventListener('load', function ()  {
     if (request.status === 200) {
          let res = JSON.parse(request.response);
         
          let show = "";
          for (let key in res){
             if ((!(key === 'target' || key === 'getOrSet')))
              {
               show += key + ": " + res[key] + "\n"; 
             }
              
          }
          if(input === "age" || input === "entryYear" || input === "subNumber"){
              alert(request.response);
          }
          else{
              alert(show);
          }
     }
  });
 }
}


