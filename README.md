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
- [ ] EDIT
- [ ] DELETE
#### Endereços

- [x] INDEX
- [x] SHOW
- [x] STORE
- [ ] EDIT
- [ ] DELETE

#### Relationships

- [x] Um cliente possui vários Endereços
- [x] Um endereço pertence a um único cliente
