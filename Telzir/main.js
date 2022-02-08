/*
    Telzir Project
    Author: Cleydson Rodrigues
    Description: This script import all main modules. 
*/

import { popup, popupShow, popupHide, popupResultShow, popupResultHide, popupAlert, popupAlertHide } from './src/js/popup'
import { icon } from './src/js/icons'


/*--------------------------------------

•>DOM Elements atribuitions
*/
//--------- Card Butons ----------
let btn30 = document.querySelector("#btn-simulate-30")

let btn60 = document.querySelector("#btn-simulate-60")

let btn120 = document.querySelector("#btn-simulate-120")

//------ Form Buttons atribuition -------
let btnFormClose = document.querySelector("#btn-form-close")

let btnFormSimulate = document.querySelector("#btn-form-simulate")

let btnResultBack = document.querySelector("#btn-result-back")

let btnResultContact = document.querySelector("#btn-result-contact")

let inputDDDorigin = document.getElementById("input-ddd-origin")

let btnContractPromo30 = document.querySelector("#btn-contract-promo-30")

//---- Card Buttons atribuitions ----
let btnContractPromo60 = document.querySelector("#btn-contract-promo-60")

let btnContractPromo120 = document.querySelector("#btn-contract-promo-120")

//----- Popup Buttons atribuitons ----
let btnPopupAlert = document.querySelector("#popup-alert-btn")

let btnTabela= document.querySelector("#btn-tabela")


/*--------------------------------------

•>Event Listeners
*/
//--------- Buttons Simulate ---------
btn30.addEventListener("click", function(){
  popupShow(30,30)
})

btn60.addEventListener("click", function(){
  popupShow(60,30)
})

btn120.addEventListener("click", function(){
  popupShow(120,30)
})

//---------- PopUp Events -------------
btnFormClose.addEventListener("click", function(){
  popupHide()
})

btnFormSimulate.addEventListener("click",function(){
  
  
  var dddOrigin = document.querySelector("#input-ddd-origin")
  var dddDestination = document.querySelector("#input-ddd-destination")
  var callDuration = document.querySelector("#input-call-duration")
  var promo = document.querySelector("#input-promo")
  
  dddOrigin = dddOrigin.value
  dddDestination = dddDestination.value
  callDuration = parseInt(callDuration.value)
  promo = parseInt(promo.value)
  
  if(dddDestination == "null"){
    popupAlert(icon().exclamation+" Atenção","Escolha o DDD de destino antes de continuar.")
    return false;
  }

  
//JQUERY AJAX
 $.ajax({
        method: "POST",
        url: "requests.php",
        data: {dddOrigin: dddOrigin, dddDestination: dddDestination, callDuration: callDuration, promo: promo, getValues: true}
      }).done((msg)=>{
       
        let r = JSON.parse(msg)
        r.callDuration = callDuration
        r.promo = promo
        if(r.error){
          popupAlert("Erro", "<center>"+r.error+"</center>")
        }
        popupResultShow(r)
      }).fail(()=>{
        popupAlert("Erro", "<center>Erro ao conectar no servidor.</center>")
      })


  popupHide()
  
})//btnFormSimulate

//---------- PopUp Result -----------
btnResultBack.addEventListener("click", function(){
  popupResultHide()
  popupShow()
})

btnResultContact.addEventListener("click", function(){
  popupAlert(icon().tools+" Serviço indisponível", "Tente novamente mais tarde")
})

//-------- table (AJAX) --------
btnTabela.addEventListener("click",function(){
  popupAlert("Tabela de valores", "Carregando...")
  $("#popup-alert-message").load("templates/table.tpl")
})

//--- Card Contract button Events ---
btnContractPromo30.addEventListener("click", function(){
  popupAlert(icon().wrench+" Em manutenção","<p>Serviço indisponível no momento.</p><p>Experiente fazer uma simulação por enquanto.<br> Depois você pode contratar o plano de 30 minutos</p>")
})

btnContractPromo60.addEventListener("click", function(){
  popupAlert(icon().wrench+" Em manutenção","<p>Serviço indisponível no momento.</p><p>Experiente fazer uma simulação por enquanto.<br> Depois você pode contratar o plano de 60 minutos</p>")
})

btnContractPromo120.addEventListener("click", function() {
  popupAlert(icon().wrench+" Em manutenção", "<p>Serviço indisponível no momento.</p><p>Experiente fazer uma simulação por enquanto.<br> Depois você pode contratar o plano de 120 minutos</p>")
})

//------- Popup Alert Event -----------
btnPopupAlert.addEventListener("click", function(){
  popupAlertHide()
})


/*----------------------------------
 
 •> Layout Update
*/
//--DDD Destination List Update event--
//Desc: This refresh the popup to apply update modification of the DDD Destination field
inputDDDorigin.addEventListener("change", (e)=>{
 
  let promo = document.getElementById("input-promo")
  promo = promo.value
  
  var callDuration = document.getElementById("input-call-duration")
  callDuration = callDuration.value
  
  let dddOrigin = document.getElementById("input-ddd-origin")
  dddOrigin = dddOrigin.value
  
  popupHide()
  popupShow(promo, callDuration, dddOrigin)
  
})