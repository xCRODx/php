/*
    Cleydson Rodrigues
    
   -Use this script to test application modules/functions
   
*/


import { callValueDiscount, callValueNoDiscount } from '../src/js/promo'


// QUnit Tests

/* ----------------------------------
    FIRST TEST:  Calculate value with Discount
    ddd origin: 011
    ddd destinatiom: 017
    call duration: 80 min
    promo: 60 minutes
    value expected: R$37,40
*/
  var value=callValueDiscount("011","017",80.000000001,60.0000000)
  var expected=37.40;
  
  QUnit.test( "Test 1 - Promo Discount function result", function( assert ) {
    assert.equal(value, expected, "Passed")
  });
//-----------------------------------
  
  
/* ----------------------------------
    SECOND TEST: calculate value without Discount
    ddd origin: 011
    ddd destinatiom: 017
    call duration: 80 min
    promo: No promo
    value expected: R$136,00
*/

  var value=callValueNoDiscount("011","017",80)
  var expected=136.00;
  
  QUnit.test( "Test 2 - Promo No discount function result", function( assert ) {
    assert.equal(value, expected, "Passed")
  });
//------------------------------------

  
/* -----------------------------------
    THIRD TEST: calculate with  Discount
    ddd origin: 018
    ddd destinatiom: 011
    call duration: 200 min
    promo: 120 minutes
    value expected: R$167,20
*/

  var value=callValueDiscount("018","011",200,120)
  var expected=167.20;
  
  QUnit.test( "Test 3 - Promo discount function result", function( assert ) {
    assert.equal(value, expected, "Passed")
  });