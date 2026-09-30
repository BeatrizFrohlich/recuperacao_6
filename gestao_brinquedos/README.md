# Sistema de Gestão de Brinquedos (CRUD PHP)

Este projeto foi desenvolvido como Atividade de Recuperação da atividade 6 para demonstrar o uso prático de operações CRUD (Create, Read, Update, Delete) utilizando PHP estruturado e Banco de Dados MySQL com Prepared Statements.

## Funcionalidades

- **Cadastrar Brinquedo:** Permite registrar um brinquedo informando Nome, Categoria, Faixa Etária, Preço e Quantidade.
- **Listar Brinquedos:** Exibe todos os brinquedos armazenados no banco de dados em uma tabela clara.
- **Editar Brinquedo:** Permite atualizar dados de um brinquedo já cadastrado.
- **Excluir Brinquedo:** Remove um brinquedo do sistema após confirmação.
- **Segurança:** Uso de Prepared Statements em todas as operações SQL (prevenção contra SQL Injection) e sanitização/validação dos dados informados pelo usuário.

## Tecnologias Utilizadas

- **PHP** (Conexão via PDO)
- **MySQL** (Banco de Dados Relacional)
- **HTML** (Interface do usuário)