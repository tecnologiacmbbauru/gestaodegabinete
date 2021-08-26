# GESTÃO DE GABINETE

<p align="center"><img src="https://github.com/tecnologiacmbbauru/gestaodegabinete/blob/main/public/utils/gab-git.png" width="400"></p>

<p align="center">
    <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
</p>

# Sobre

"Gestão de Gabinete" consiste em um <i>software</i>, voltado para Agentes Políticos e Assessores Parlamentares, tendo como principal objetivo auxiliar as atividades diárias realizadas nos Gabinetes.

# Licença
O software foi desenvolvido pelo **Serviço Tecnológico em Informática da Câmara Municipal de Bauru** / São Paulo em **software livre e aberto**, sob Licença Pública Geral [GNU](http://www.gnu.org/licenses/).
Ele utiliza o Framework Laravel PHP, bem como o servidor Apache e o banco de dados MySQL.

# Instalação e Configuração

## Pré-Requisitos 
Para o software funcionar corretamente, é necessário instalar: [Composer](https://getcomposer.org/) - gerenciador de dependências e bibliotecas para softwares PHP, webserver Apache e servidor de banco de dados Mysql. 

## Instalação
Primeiro, execute o comando para clonar o projeto do GitHub:

**_git clone --branch multi-tenancy https://github.com/tecnologiacmbbauru/gestaodegabinete.git_**

Após clonar o repositório, acesse a pasta do sistema e instale todas as dependências, executando o comando:

**_composer install_**

## Banco de dados
Efetue a criação do Banco de Dados principal.

Copie o arquivo _.env.example_, renomeie a cópia para **.env** e altere conforme as configurações do seu banco de dados:

> DB_CONNECTION=tenant

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=gab_host

> DB_USERNAME=example_user

> DB_PASSWORD=example_password

**Atenção:** O campo _DB_CONECTION_ deve ser igual a _tenant_, os demais campos são configurações do seu banco de dados.

**Atenção:** Certifique-se de que o usuário do banco de dados, definido neste arquivo, tenha todas permissões necessárias (deve ser super usuário).


## Configurações para funcionamento do sistema

Altere, ainda no arquivo .env, as informações : APP_ENV, APP_DEBUG e APP_URL de acordo com as configurações do servidor.
Para a APP_URL você deve colocar a url do servidor (IP ou hostname) / nome da pasta do projeto (padrão gestaodegabinete)
Default: http://seudominioouip/gestaodegabinete

 Defina uma nova chave para o sistema (no arquivo .env), utilizando o comando:

 **_php artisan key:generate_**

Crie um link simbólico apontando para a pasta storage/app/public, onde são armazenados imagens e documentos do sistema, utilizando o comando:

**_php artisan storage:link_**

Crie as tabelas necessárias para o banco de dados do sistema, executando o comando:

**_php artisan migrate_**

Crie o usuário administrador do sistema, utilizando o comando:

**_php artisan db:seed_**


## Criação do VirtualHost no Apache
Criar um arquivo de ambiente virtual chamado gestaodegabinete.conf na pasta padrão do Apache, conforme conteúdo abaixo:

><VirtualHost *:80>
>ServerName seudominioouip
>ServerAdmin seuemail@seudominio.com.br
>DocumentRoot /pasta_raiz_do_Apache
>Alias /gestaodegabinete /pasta_raiz_do_Apache/gestaodegabinete/public
><Directory /pasta_raiz_do_Apache/gestaodegabinete/>
>    Options FollowSymLinks
>    Options -Indexes
>    AllowOverride All
>    Require all granted
></Directory>
>ErrorLog ${APACHE_LOG_DIR}/gestaodegabiente_error.log
>CustomLog ${APACHE_LOG_DIR}/gestaodegabinete_access.log combined
></VirtualHost>

Ativar o ambiente virtual e reiniciar o serviço do Apache.

**OBS:Se o nome da pasta do projeto for alterado (padrão gestaodegabinete), também deverá ser alterado o conteúdo do arquivo de ambiente virtual do Apache (gestaodegabinete.conf) e a linha 23 do arquivo .htacess na pasta public.**

# Permissões para o sistema operacional Linux
Executar os seguintes comandos na pasta do projeto:

sudo chmod 777 storage -R   
sudo chmod 777 bootstrap -R
sudo chown usuario_apache:usuario_apache /var/www/html/gestaodegabinete -R
php artisan config:clear
php artisan cache:clear
composer dump-autoload
php artisan view:clear
php artisan route:clear


# Primeiro Acesso ao sistema
Acesse o sistema e efetue login utilizando **usuário:system / senha:system**. 

Após login, **troque a senha** e acesse o **Manual do Administrador** para conhecer o processo de criação dos Gabinetes e Usuários.


# Módulos externos
Este software utiliza **webservice gratuito <a href="https://viacep.com.br/">Via CEP</a>** no cadastro de Pessoas para consultar Códigos de Endereçamento Postal (CEP) do Brasil.

A Agenda utilizada no software exibe eventos do **Google Agenda**. Para utilizá-la, é necessário cadastrar as Chaves do Google Agenda.

# Versão Demonstrativa
Para conhecer o software, acesse a **versão demonstrativa**: https://intranet.bauru.sp.leg.br/gabdemo/.

Efetue login utilizando **usuário:admin / senha:admin**.

# Manuais
Para conhecer as funcionalidades do software, consulte o [Manual do Usuário.](https://github.com/tecnologiacmbbauru/gestaodegabinete/blob/multi-tenancy/public/utils/Manual_do_Usuario.pdf)

Sobre a parte técnica, consulte o [Manual do Administrador.](https://github.com/tecnologiacmbbauru/gestaodegabinete/blob/multi-tenancy/public/utils/Manual_do_Administrador.pdf)

# Contato
Para dúvidas, sugestões e/ou esclarecimentos, entre em **contato** com o Serviço Tecnológico em Informática da Câmara Municipal de Bauru/SP.


>**Email**: tecnologia@bauru.sp.leg.br  
>**Portal Legislativo**: https://www.bauru.sp.leg.br

