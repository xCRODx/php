import { log, convertToReal as toReal } from './utils'

//------------ popupResult-----------
let drawPopupResult = (result) => {
  var r = result
  
  var divFreeTax = document.querySelector("#result-is-free-tax")
  var divNotFreeTax = document.querySelector("#result-not-free-tax")
  
  var resultDiscountMessage = document.querySelector("#result-discount-message")
  var resultDiscountValue = document.querySelector("#result-discount-final-value")
  var resultNoDiscountValue = document.querySelector("#result-no-discount-final-value")
  var resultDiscountFreeTax = document.querySelector("#result-discount-free-tax")
  
  var noDiscountValue = toReal(r.noDiscountValue.toFixed(2))
  resultNoDiscountValue.innerHTML = "R$"+noDiscountValue
  
  if(r.discountValue>0){//if isnt tax free
    
    var savedValue = (r.noDiscountValue - r.discountValue).toFixed(2)
    
    var percentSavedValue = ((savedValue*100)/r.noDiscountValue).toFixed(2)
    
    var resultDiscountMessageTxt = "Você economiza R$"+toReal(savedValue)+"<br>"+percentSavedValue+"% de desconto ao falar "+r.callDuration+" minutos no plano #FaleMais"+r.promo
    
    resultDiscountMessage.innerHTML = resultDiscountMessageTxt
    
    var discountValue = toReal(r.discountValue.toFixed(2))
    
    resultDiscountValue.innerHTML = "R$"+discountValue
    
    divNotFreeTax.style.display = "initial"
    divFreeTax.style.display = "none"
    
  }else{//if is tax free
    
    divFreeTax.style.display = "initial"
    divNotFreeTax.style.display = "none"
    
    var resultDiscountMessageTxt = "Falando até "+r.promo+" minutos você não paga nada"
    
    resultDiscountMessage.innerHTML = resultDiscountMessageTxt
    
    resultDiscountFreeTax.innerHTML = "R$"+toReal((r.discountValue).toFixed(2))
  }
}//drawPopupResult


export { drawPopupResult }