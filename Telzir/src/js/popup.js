/*
  Description: manage all popups on aplication
*/

import { drawPopupResult } from './layout'
import { convertToReal as toReal} from './utils'


let popup = () => {
 return document.querySelector("#popup-simulate")
}

let popupResult = () => {
  return document.querySelector("#popup-result")
}


let popupShow = (promo = null, callDuration =null ,dddOrigin=null) => {
 
   popup().style.display = "initial"
   
   var inputDDDorigin = document.querySelector("#input-ddd-origin")
   var inputCallDuration = document.querySelector("#input-call-duration")
   var inputPromo = document.querySelector("#input-promo")
   
   var destinationDDDelement = document.querySelector("#destination-ddd-element");
   if( promo != null ){
      inputPromo.value = promo
   }
  
   inputDDDorigin = inputDDDorigin.value
   inputCallDuration = inputCallDuration.value
   
   //draw the select options based on origin DDD
  //print in layout the DDD inputs that are compatible from database
    $.ajax({
        method: "POST",
        url: "dddDestinationOptions.php",
        data: {dddOrigin: inputDDDorigin, getDDD: true}
        
      }).done((msg)=>{
        var dddLayout = msg
        destinationDDDelement.innerHTML = dddLayout
      }).fail(()=>{
       
      })
      
   
}// popupShow


let popupHide = () =>{
  popup().style.display = "none"
}


let popupResultShow = (result) => {
  
  var r = result
  popupResult().style.display = "initial"
  
  drawPopupResult(result)
  
}//popupResultShow

let popupResultHide = () => {
  popupResult().style.display = "none"
}

let popupAlert = (title,msg) => {
  
  var popup = document.querySelector("#popup-alert")
  var popupTitle = document.querySelector("#popup-alert-title")
  var popupMsg = document.querySelector("#popup-alert-message")
  
  popupTitle.innerHTML = title
  popupMsg.innerHTML = msg
  popup.style.display = "initial"
  
}


let popupAlertHide = () => {
  var popup = document.querySelector("#popup-alert")
  popup.style.display = "none"
}


export { popup, popupShow, popupHide, popupResultShow, popupResultHide, popupAlert, popupAlertHide}