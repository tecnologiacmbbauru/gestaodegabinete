# GESTÃO DE GABINETE

<p align="center"><img src="https://github.com/tecnologiacmbbauru/gestaodegabinete/blob/main/public/utils/gab-git.png" width="400"></p>

<p align="center">
    <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
</p>

# Sobre

"Gestão de Gabinete" consiste em um <i>software</i>, voltado para Agentes Políticos e Assessores Parlamentares, tendo como principal objetivo auxiliar as atividades diárias realizadas nos Gabinetes.

# Licença
O software foi desenvolvido pelo **Serviço Tecnológico em Informática da Câmara Municipal de Bauru** / São Paulo em **software livre e aberto**, sob Licença Pública Geral [GNU](http://www.gnu.org/licenses/).

# Instalação e Configuração

## Pré Requisitos 
Para funcionamento do software, é necessário instalar o [Composer](https://getcomposer.org/)- gerenciador de dependências e bibliotecas para softwares PHP.

## Instalação
Para instalar, basta você clonar o projeto do GitHub:

**_git clone --branch multi-tenancy https://github.com/tecnologiacmbbauru/gestaodegabinete.git_**

Navegar até a pasta com a instalação e rodar o comando:

**_composer install_**

## Banco de dados
Então copie o arquivo **.env.example** e renomeei a cópia para **.env**.

Neste arquivo, você vai alterar as configurações do banco de dados:

> DB_CONNECTION=tenant

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=gab_host

> DB_USERNAME=example_user

> DB_PASSWORD=example_password

**Atenção:** O campo _BD_CONECTION_ deve ser igual a _tenant_, os demais campos são configurações do banco de dados.

**Atenção:** O usuário e senha neste arquivo devem ter as permissões necessárias (super usuário).

## Configurações para funcionamento do sistema
Depois do sistema instalado e o banco de dados configurado com super usuário no arquivo **.env**, então podemos realizar os comandos para o pleno funcionamento. Dentro do caminho onde o sistema está instalando, vamos criar uma chave para o sistema com o comando:

**_php artisan key:generate_**

O sistema também utiliza um link simbólico da pasta public para pasta _storage_, onde os arquivos são armazenados. Para criar este link rode o comando:

**_php artisan storage:link_**

Agora precisamos apenas criar as tabelas necessárias para nosso banco de dados rodar, para isto execute o comando:

**_php artisan migrate_**

E criamos um usuário administrador com o comando:

**_php artisan db:seed_**

A partir disto, você já pode acessar o sistema pelo link do seu servidor apache.

O usuário e senha padrão é **system/system**.  Após logon, troque a senha.


# Módulos externos
Este software utiliza **webservice gratuito <a href="https://viacep.com.br/">Via CEP</a>** no cadastro de Pessoas para consultar Códigos de Endereçamento Postal (CEP) do Brasil.

A Agenda utilizada no software exibe eventos do **Google Agenda**. Para utilizá-la, é necessário cadastrar as Chaves do Google Agenda.

# Versão Demonstrativa
Para conhecer o software, acesse a **versão demonstrativa**: https://intranet.bauru.sp.leg.br/gabdemo/.

# Mais informações
Para mais detalhes sobre as funcionalidades do software, consulte o **Manual do Usuário**.

Para  dúvidas  e/ou  esclarecimentos, entre  em **contato**  com  o Serviço  Tecnológico  em  Informática da Câmara  Municipal  de Bauru/SP. 

>**Email**: tecnologia@bauru.sp.leg.br  
>**Portal Legislativo**: https://www.bauru.sp.leg.br

