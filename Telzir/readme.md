Project: Telzir
Author: Cleydson Rodrigues
version: v1.0.1
Description: Simple Mobile Web aplication

Back End: PHP, MySQL.
Front End: JavaScript(ES8), Bootstrap, JQuery e QUnit para os testes unitários.


### Instalação/execução

> Para rodar a aplicação, é necessário um web server Apache/NGINX junto a um banco de dados MySQL.

>  o arquivo 'telzir.sql' e abrir o arquivo index.php na pasta raíz

> Layout projetado para Mobile/Web

> necessário conexão com internet para carregamento de fontes e scripts externos da CDN.


### Testes Unitários

> Os testes estão disponíveis apenas em JavaScript. Os cálculos são feitos no próprio browser.

> Nos testes unitários foi usada a biblioteca QUnit. Para iniciar, basta abrir o arquivo test.html na pasta raíz

> O script de tests.js na pasta ./test/ carrega os modulos das funções da aplicação por meio do comando import (ES8)

> Pode-se acrescentar mais testes escolhendo o arquivo a ser importado e  declarando o módulo no script de test

### Estrutura da aplicação

 Front End

> Toda estrutura html está quebrada em pequenos componentes como Header, Footer...

> Script principal main.js na pasta raíz, É a base do sistema. Cuida de captar os eventos de clicks dos botões update do DOM.

> Os módulos/funções se encontram na pasta ./src/js e são importados em tempo de execução.

  Back End

> A parte em php exige um banco de dados MySQL configurado.

> pode se configurar o acesso ao banco na pasta raíz no arquivo 'config.php'. 

> Nenhuma outra configuração é necessária

