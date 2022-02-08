<!-- 
 >>This is the base template of each page
 >> Contains all popUp divs
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no user-scalable=no">
    <title>Telzir - #FaleMais</title>
      <link rel="icon" type="image/x-icon" href="src/img/favicon.ico">
      
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100&display=swap" rel="stylesheet">
    <!-- fonts -->
    <link rel="stylesheet" href="src/css/app.css">
    <link rel="stylesheet" href="src/css/fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="//unpkg.com/systemjs@0.19.47/dist/system.js"></script>
  </head>
  <body>
    
    <div class="text-center font-open-sans" id="APP">
      
    {{header}}
      
    {{page}}
    
    {{footer}}
    
      <div id="popup-simulate" style="display: none;" class="popup-main">
        <div id="popup-simulate-form" class="shadow-2 font-noto popup" style="">
          <h5 class="form-title"><b>Faça uma simulação</b></h5>
          <label class="form-label">DDD origem: </label>
          <center class="input-group mb-3">
            <div class="input-group-prepend"></div>
            <select class="custom-select input-promo-form" id="input-ddd-origin" style="align-text: center;">
              <option value="011" selected>011</option>
              <option value="016">016</option>
              <option value="017">017</option>
              <option value="018">018</option>
            </select>
          </center>
          <label class="form-label">
            DDD destino: </labell>
            <div id="destination-ddd-element">
         {{dddDestinationOptions}}
         </div>
          <label>Promoção: </label>
          <div class="input-group mb-3">
            <div class="input-group-prepend"></div>
            <select class="custom-select input-promo-form" id="input-promo">
              <option value="30" selected>FaleMais30</option>
              <option value="60">FaleMais60</option>
              <option value="120">FaleMais120</option>
            </select>
          </div>
          <label class="form-label">Quantos minutos quer falar:</label>
          <input type="number" id="input-call-duration" class="input-group mb-3 input-promo-form" name="call-duration" value="30" >
          <hr>
          <div id="#form-buttons-simulate" style="width: 100%;">
            <button id="btn-form-simulate" class="btn app-btn app-btn-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-app-indicator" viewBox="0 0 16 16">
                <path d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"/>
                <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              </svg>
              Calcular
            </button>
            <button id="btn-form-close" class="btn app-btn app-btn-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
              Fechar
            </button>
          </div>
        </div>
      </div>
      <!-- popUp Simulate -->
      <div id="popup-result" class="popup-main" style="text-align: center; display: none;">
        <div class="popup shadow-2" id="popup-result-content">
          <h5><b>Veja o quanto você economiza com a gente</b></h5>
          <div class="font-noto">
            <!--Discount Layout-->
            <p id="result-discount-message" style="color: #bbbbbbdd">${ResultDiscountMessage}</p>
            <div id="result-is-free-tax">
              <div class="result-info result-free-tax">
                <small id="result-small-message" class="small font-roboto"><b>Com o nosso plano</small>
                <p id="result-discount-free-tax">R$%FreeTax</p>
              </div>
            </div>
            <div id="result-not-free-tax">
              <div class="result-info result-discount">
                <small id="result-small-message" class="small font-roboto"><b>Com o nosso plano</small>
                <p id="result-discount-final-value">R$%discountValue</p>
              </div>
              </div>
              <div class="result-info result-no-discount">
                <small id="result-small-message" class="small font-roboto"><b>Sem o nosso plano</small>
                <p id="result-no-discount-final-value">R$%noDiscountvalue</p>
              </div>
            
            <!--no free tax -->
            <button id="btn-tabela" class="btn app-btn app-btn-2"><small> >Consulte a tabela de valores< </small></button>
          </div>
          <hr>
          <div id="popup-result-footer">
            <button id="btn-result-contact" class="btn app-btn app-btn-1">Contratar</button>
            <button id="btn-result-back" class="btn app-btn app-btn-2">Voltar</button>
          </div>
        </div>
      </div>
      <!-- popUp Result -->
      <div id="popup-alert" class="popup-main" style="display:none;">
        <div class="popup shadow-2 popup-base">
          <h5 id="popup-alert-title" class="font-open-sans" style="border-bottom:solid 1px; border-color: #ddd; padding-bottom: 10px;">${title}</h5>
          <h6 id="popup-alert-message" class="font-noto" style="color:#544;">${message}</h6>
          <hr>
          <button id="popup-alert-btn" class="btn app-btn app-btn-1" style="padding-left: 20px; padding-right: 20px; margin-top:0;">Ok</button>
        </div>
      </div>
    </div>
    <!--APP-->
    <script src="config.js"></script>
  </body>
</html>