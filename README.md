# Team Soft Backend PHP

Desafio proposto pela Team Soft como teste para ingressar na equipe.

## Proposta

O desafio consiste em:

- Criar as operações básicas de (Cadastro, Leitura, Alteração e Remoção de Clientes com endereço, ou seja um CRUD)
- Construir 2 entidades separadas (Cliente e Endereço)
- Um cliente pode ter mais de um endereço
- A aplicação resultante deve ser uma API REST;

### Entidades:

#### Cliente

- CNPJ (Obrigatório)
- Razão Social (Obrigatório)
- Nome do Contato (Obrigatório)
- Telefone (Obrigatório)

#### Endereço

- Logradouro (Obrigatório)
- Número (Obrigatório)
- Complemento
- Bairro (Obrigatório)
- Cidade (Obrigatório)
- Estado (Obrigatório)
- CEP (Obrigatório)
- Latitude (Somente leitura, bonus points)
- Longitude (Somente leitura, bonus points)

## Obrigatório

- PHP
- Laravel
- Validação de Campos
- Poderá ser utilizado Mysql ou MongooDB. (se optar por Mysql, faça migration ou um .sql com o script de criação das tabelas)

## Bonus points

- Documentação
- Buscar a Latitude e longitude com o google
- Testes

## Entregando o teste

Suba seu projeto no github de forma pública e envie o link no [formulário](https://forms.gle/XTgmwXbvHUZhgygu7) com seus dados.Este teste é apenas para quem se inscreveu no processo de seleção.

### Checklist

#### Clientes

- [x] INDEX
- [x] SHOW
- [x] STORE
- [x] EDIT
- [x] DELETE
#### Endereços

- [x] INDEX
- [x] SHOW
- [x] STORE
- [x] EDIT
- [ ] DELETE

#### Relationships

- [x] Um cliente possui vários Endereços
- [x] Um endereço pertence a um único cliente

### Validations

**Clientes**

- [x] CNPJ (Obrigatório e único)
- [x] Razão Social (Obrigatório)
- [x] Nome do Contato (Obrigatório)
- [x] Telefone (Obrigatório)

**Endereços**

- [x] Logradouro (Obrigatório)
- [x] Número (Obrigatório e numérico)
- [x] Bairro (Obrigatório)
- [x] Cidade (Obrigatório)
- [x] Estado (Obrigatório)
- [x] CEP (Obrigatório e numérico)

## Breakpoints
#### Clientes

| URI                 | MÉTODO  | DESCRIÇÃO                                |
|--------------------|---------|-------------------------------------------|
| api/customers      | GET     | Lista os clientes                         |
| api/customers      | POST    | Cria um cliente                           |
| api/customers/{id} | GET     | Exibe detalhes de um cliente específico   |
| api/customers/{id} | PUT     | Altera os dados de um cliente             |
| api/customers/{id} | DELETE  | Remove um cliente                         |
#### Endereços

| URI                 | MÉTODO  | DESCRIÇÃO                                |
|---------------------|---------|------------------------------------------|
| /api/addresses      | GET     | Lista os endereços                       |
| /api/addresses      | POST    | Cria um endereço                         |
| /api/addresses/{id} | GET     | Exibe detalhes de um endereço específico |
| /api/addresses/{id} | PUT     | Altera os dados de um endereço           |
| /api/addresses/{id} | DELETE  | Remove um endereço                       |
