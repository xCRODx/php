/*
  Author: Cleydson Rodrigues
  Description: Package of useful modules to help in development process
*/

let log = (message) => {
  console.log(message)
}

let convertToReal = (value) => {
  return value.toString().replace(".", ",");
}


export { log, convertToReal }