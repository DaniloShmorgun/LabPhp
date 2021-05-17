import {formJSSend} from './request-send.js';



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
        digits:true,
        pattern: /^\d{12}$/,
        rangelength: [12, 12],

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
    submitHandler: function (form = "#") {
      
      formJSSend(form)
  

    
}

})
})
