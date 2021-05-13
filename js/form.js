function openPopup(element){
    document.querySelector(element).style.left = '100px'
};

function closePopup(element){
   document.querySelector(element).style.left = '-9999px'
};
document.querySelector('.dialog-button').onclick = () => {
   openPopup('#popup')
}

document.querySelector('#close').onclick = () => {
   closePopup('#popup')
}

const select = document.querySelector('#selector')
const now = new Date()

for (let i = 2000; i <= now.getFullYear(); i++) {
   let options = String(i)
   let el = document.createElement('option')
   el.textContent = options
   el.value = options
   select.appendChild(el) 
}

export {openPopup, closePopup}
