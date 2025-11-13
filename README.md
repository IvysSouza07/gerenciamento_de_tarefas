# CRUD-PHP

## Descrição
Este projeto é uma aplicação web de CRUD (Create, Read, Update, Delete) desenvolvida em PHP, com interface moderna e responsiva. O objetivo é gerenciar tarefas de forma simples e eficiente, utilizando um banco de dados MySQL.

## Tecnologias Utilizadas
- **PHP**: Linguagem principal para o backend e manipulação dos dados.
- **MySQL**: Banco de dados relacional para armazenamento das tarefas.
- **HTML5**: Estrutura das páginas web.
- **CSS3**: Estilização das páginas, incluindo tema moderno e responsivo.

## Instruções de Instalação e Configuração
1. **Pré-requisitos**:
   - Servidor web Apache (recomendado: XAMPP ou WAMP)
   - PHP 7.0 ou superior
   - MySQL

2. **Clonando o Projeto**:
   - Faça o download ou clone este repositório para o diretório raiz do seu servidor web:
     ```
     git clone https://github.com/seu-usuario/CRUD-PHP.git
     ```

3. **Configuração do Banco de Dados**:
   - Crie um banco de dados MySQL chamado `crud_php`.
   - Importe o arquivo de estrutura SQL (caso exista) ou execute o seguinte comando:
     ```sql
     CREATE TABLE tarefas (
         id INT AUTO_INCREMENT PRIMARY KEY,
         titulo VARCHAR(255) NOT NULL,
         descricao TEXT,
         status VARCHAR(50),
         prioridade VARCHAR(50),
         data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
     );
     ```
   - Configure o arquivo `db.php` com os dados de acesso ao seu banco de dados.

4. **Executando a Aplicação**:
   - Inicie o servidor Apache e MySQL pelo XAMPP/WAMP.
   - Acesse `http://localhost/CRUD-PHP` no navegador.

## Exemplos de Uso
- **Adicionar Tarefa**: Clique em "Adicionar" para criar uma nova tarefa preenchendo os campos obrigatórios.
- **Editar Tarefa**: Utilize o botão "Editar" ao lado de cada tarefa para modificar os dados.
- **Excluir Tarefa**: Clique em "Excluir" para remover uma tarefa do sistema.
- **Filtrar/Buscar**: Utilize os filtros disponíveis para buscar tarefas por status ou prioridade.

## Observações
- O projeto pode ser facilmente adaptado para outras finalidades de gerenciamento.
- Para dúvidas ou sugestões, consulte a documentação dos arquivos ou entre em contato com o desenvolvedor.
