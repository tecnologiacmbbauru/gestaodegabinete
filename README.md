<p align="center"><img src="https://github.com/tecnologiacmbbauru/gestaodegabinete/blob/main/public/utils/gab-git.png" width="400"></p>

<p align="center">
    <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
</p>

## Sobre o Sistema

Este é um <i>software</i>, voltado para agentes políticos e assessores parlamentares, tendo como objetivo auxiliar as atividades diárias realizadas nos gabinetes.
O <i>software</i> é disponibilizado de forma gratuita e aberta.

## Licença
O sistema Gestão de Gabinete é aberto e utiliza a licença pública geral [GNU](http://www.gnu.org/licenses/).

## Como instalar o sistema
Após clonar o repositório instale todas as dependencias dentro da pasta do projeto com

<i>composer install</i>

Renomeie o arquivo <i>.env.example</i> para <i>.env</i> e efetue as configurações do banco.

Crie uma chave de acesso para o sistema com

<i>php artisan key:generate</i>

Este sistema usa link simbolicos para ter acesso a pasta storage, para suas imagens e documentos serem carregados corretamente ultilize

<i>php artisan storage:link</i>

Então crie o banco de dados

<i>php artisan migrate</i>

e popule com as informações básicas

<i>php artisan db:seed</i>

<b>Atenção:</b> Para popular com dados de teste (Não usar na versão de produção) tire os comentários das linhas 24,25,26 do arquivo <i>DatabaseSeeder.php</i> antes de usar o comando <i>php artisan db:seed</i>.

## Módulos externos
Este software utiliza **webservice gratuito <a href="https://viacep.com.br/">Via CEP</a>** no cadastro de Pessoas para consultar Códigos de Endereçamento Postal (CEP) do Brasil.

A Agenda utilizada no software exibe eventos do **Google Agenda**. Para utilizá-la, é necessário cadastrar as Chaves do Google Agenda.

## Demonstração do Sistema
*Para conhecer o software, acesse a **versão demonstrativa**: https://intranet.bauru.sp.leg.br/gabdemo/.* 

## Mais informações
Para mais detalhes sobre as funcionalidades do software, consulte o **Manual do Usuário**.

Para  dúvidas  e/ou  esclarecimentos, entre  em **contato**  com  o Serviço  Tecnológico  em  Informática da Câmara  Municipal  de Bauru/SP. 

>**Email**: tecnologia@bauru.sp.leg.br  
>**Portal Legislativo**: https://www.bauru.sp.leg.br

