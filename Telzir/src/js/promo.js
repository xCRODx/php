import { returnCallValues } from './tableCallValues'


let callValueDiscount = ( dddOrigin, dddDestination, callDuration, promo = 120 ) => {
  
  var callValuePerMinute = returnCallValues(dddOrigin,dddDestination)
 
  //calculate exceeded time or return free tax
  if(callDuration > promo){
    var timeExceeded = callDuration-promo
  }else{
    //return 0 as the calling value
    return 0.00;
  }
  var finalCallValue = calculateFinalValueDiscount(timeExceeded, callValuePerMinute)
  return finalCallValue
  
}//export function discount()


let calculateFinalValueDiscount = (timeExceeded, callValuePerMinute) => {
  
   var value = (timeExceeded*callValuePerMinute)
  value = value + (value*0.1)
  
  return value
  
}//calculateFinalValueDiscount

let callValueNoDiscount = (dddOrigin,dddDestination,callDuration) => {
  var callValuePerMinute = returnCallValues(dddOrigin, dddDestination)
  return (callDuration*callValuePerMinute)
  }
  
  
  export{ callValueDiscount, callValueNoDiscount }