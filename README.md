# GESTÃO DE GABINETE

<p align="center"><img src="https://github.com/tecnologiacmbbauru/gestaodegabinete/blob/main/public/utils/gab-git.png" width="400"></p>

<p align="center">
    <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
</p>

## Sobre

"Gestão de Gabinete" consiste em um <i>software</i>, voltado para Agentes Políticos e Assessores Parlamentares, tendo como principal objetivo auxiliar as atividades diárias realizadas nos Gabinetes.

## Licença
O software foi desenvolvido pelo **Serviço Tecnológico em Informática da Câmara Municipal de Bauru** / São Paulo em **software livre e aberto**, sob Licença Pública Geral [GNU](http://www.gnu.org/licenses/).

## Instalação e Configuração
Após clonar o repositório, instale todas as dependências dentro da pasta do projeto, utilizando o comando:

**<i>composer install</i>**

Renomeie o arquivo <i>.env.example</i> para **<i>.env</i>** e altere conforme as configurações do seu banco de dados.

Defina uma nova chave no seu arquivo .env, utilizando o comando:

**<i>php artisan key:generate</i>**

Crie um link simbólico apontando para a pasta storage/app/public, onde são armazenados imagens e documentos do software, utilizando o comando:

**<i>php artisan storage:link</i>**

Crie o banco de dados, utilizando o comando:

**<i>php artisan migrate</i>**

Popule as tabelas com dados iniciais, utilizando o comando:

**<i>php artisan db:seed</i>**

<b>Atenção:</b> Para popular com dados de teste (não utilizar na versão de produção), retire os comentários das linhas 24,25,26 do arquivo <i>DatabaseSeeder.php</i> antes de executar o comando acima.

Acesse o sistema e efetue login utilizando *usuário:admin / senha:admin*. Após logon, **troque a senha**.

## Módulos externos
Este software utiliza **webservice gratuito <a href="https://viacep.com.br/">Via CEP</a>** no cadastro de Pessoas para consultar Códigos de Endereçamento Postal (CEP) do Brasil.

A Agenda utilizada no software exibe eventos do **Google Agenda**. Para utilizá-la, é necessário cadastrar as Chaves do Google Agenda.

## Versão Demonstrativa
Para conhecer o software, acesse a **versão demonstrativa**: https://intranet.bauru.sp.leg.br/gabdemo/.

## Mais informações
Para mais detalhes sobre as funcionalidades do software, consulte o **Manual do Usuário**.

Para  dúvidas  e/ou  esclarecimentos, entre  em **contato**  com  o Serviço  Tecnológico  em  Informática da Câmara  Municipal  de Bauru/SP. 

>**Email**: tecnologia@bauru.sp.leg.br  
>**Portal Legislativo**: https://www.bauru.sp.leg.br

