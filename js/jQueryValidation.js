import {formJSSend, formJQuerySend,closePopup,openPopup} from './request-send.js';

let person = {}

$(function(){
  $('#My_Form').validate({
    rules:{
      email:{
        required: true,
        email: true
      },
       first_name:
       {
         required:true,
         pattern: /^[а-яА-ЯA-Za-zіІЇїЄє]+$/

       },
       last_name:
       {
         required:true,

         pattern: /^[а-яА-ЯA-Za-zіІЇїЄє]+$/
       },
       number:
       {

        required:true,
        pattern: /^\d{12}/


       },
       password:
       {
         required: true
       }

    },
    messages: {
      email:{
        required: 'Будь ласка, введіть емейл',
        email: "Будь ласка, введіть правильний формат емейла (example@example.com)"
      },

      first_name:{
        required: "Будь ласка, введіть ім'я",
        pattern:"Будь ласка, введіть ім'я кирилицею або латиницею"
      },
       last_name:{
        required: 'Будь ласка, введіть прізвище',
        pattern:"Будь ласка, введіть ім'я кирилицею або латиницею"
       },

       password:{
       required: 'Будь ласка, введіть пароль',
       },
       number:{
         required: 'Будь ласка, введіть номер',
         pattern:"Будь ласка, введіть номер у </br> вигляді 12 цифр"
           }
     },
    submitHandler: function (form) {
    const chooser = prompt('Enter "jq" if you want jQuery_send, enter "js" if you want JavaScript_send')

    if (chooser === 'jq') {
        person = formJQuerySend(form)
    }
    else{
        person = formJSSend(form)
    }
    openPopup('#response-popup')
    
}

})
})
