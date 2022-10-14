form = document.querySelector("#forms")

form.addEventListener("submit", (e)=> {

    let element_x = document.querySelector('.x')
    let errorX = document.querySelector('#errorX')
    let errorY = document.querySelector('#errorY')
    errorX.innerHTML = ""
    errorY.innerHTML = ""
    let value_of_element = element_x.value
    let int_value_x = parseInt(value_of_element)

    if(isNaN(int_value_x)){
        errorX.innerHTML = "Введены не корректные данные. Повторите ввод!"
        e.preventDefault()
        return false
    }
    if(int_value_x<-3 || int_value_x>5) {
        errorX.innerHTML = "Введены не корректные данные. Повторите ввод!"
        e.preventDefault()
            return false
        }

    let element_y = document.querySelectorAll('.y')
    let count_check = 0;
    for(let i = 0; i<element_y.length;i++){
        if(element_y[i].checked) count_check++
    }
    if(count_check!=1){
        errorY.innerHTML = "Выберите одно значение Y!"
        e.preventDefault()
        return false
    }
})