# Desafio | Backend

O desafio consiste em usar a base de dados em SQLite disponibilizada e criar uma **rota de uma API REST** que **liste e filtre** todos os dados. Serão 10 registros sobre os quais precisamos que seja criado um filtro utilizando parâmetros na url (ex: `/registros?deleted=0&type=sugestao`) e retorne todos resultados filtrados em formato JSON.

Você é livre para escolher o framework que desejar, ou não utilizar nenhum. O importante é que possamos buscar todos os dados acessando a rota `/registros` da API e filtrar utilizando os parâmetros `deleted` e `type`.

* deleted: Um filtro de tipo `boolean`. Ou seja, quando filtrado por `0` (false) deve retornar todos os registros que **não** foram marcados como removidos, quando filtrado por `1` (true) deve retornar todos os registros que foram marcados como removidos.
* type: Categoria dos registros. Serão 3 categorias, `denuncia`, `sugestao` e `duvida`. Quando filtrado por um `type` (ex: `denuncia`), deve retornar somente os registros daquela categoria.

O código deve ser implementado no diretorio /source. O bando de dados em formato SQLite estão localizados em /data/db.sq3.

Caso tenha alguma dificuldade em configurar seu ambiente e utilizar o SQLite, vamos disponibilizar os dados em formato array. Atenção: dê preferência à utilização do banco SQLite.

Caso você já tenha alguma experiência com Docker ou queira se aventurar, inserimos um `docker-compose.yml` configurado para rodar o ambiente (utilizando a porta 8000).

Caso ache a tarefa muito simples e queira implementar algo a mais, será muito bem visto. Nossa sugestão é implementar novos filtros (ex: `order_by`, `limit`, `offset`), outros métodos REST (`GET/{id}`, `POST`, `DELETE`, `PUT`, `PATCH`), testes unitários etc. Só pedimos que, caso faça algo do tipo, nos explique na _Resposta do participante_ abaixo.

# Resposta do participante
Para esse projeto foi utilizado o Laravel, dentro da pasta source digite o seguinte comando para iniciar a api: _php artisan serve_
Alterei o banco para que o campo id fosse auto increment.

### Rotas:
As rotas de listagem, store e update possuem request personalizados para fazer a validação dos parâmetros passados e garantir a integridade dos dados.

* Listar todos os registros: **GET - /registros**
    - **deleted:** nullable| boolean - filtre registros a partir do campo deleted
    - **type:** nullable | string | ['denuncia', 'sugestao', 'duvida'] - filtre por tipo
    - **orderBy:** nullable | string | ['type', 'message', 'whistleblower_name', 'whistleblower_birth', 'created_at'] - ordene a listagem por cada coluna da tabela
    - **is_identified:** nullable | boolean - filtre registros a partir do campo is_identified
    - **page:** nullable | integer | gt:0 | required_with:per_page - número da página para retornar
    - **per_page:** nullable | integer | gt:0 | required_with:page - número de itens por página
* Retorno de um registro específico: **GET - /registros/{id}**
* Store novo registro: **POST - /registros**
    - **type:** required | string | ['denuncia', 'sugestao', 'duvida']
    - **message:** required | string
    - **is_identified:** required | boolean
    - **whistleblower_name:** nullable | string
    - **whistleblower_birth:** nullable | date_format:Y-m-d
    - **deleted:** required | boolean
* Update de um registro específico: **PUT - /registros/{id}**
    - **type:** nullable | string | ['denuncia', 'sugestao', 'duvida']
    - **message:** string
    - **is_identified:** boolean
    - **whistleblower_name:** string
    - **whistleblower_birth:** date_format:Y-m-d
    - **deleted:** boolean
* DELETE - /registros/{id}