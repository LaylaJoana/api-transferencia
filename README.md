# Informações gerais sobre o projeto

Api de transferência bancário entre usuários.

#### Ferramentas utilizadas no projeto

- [X] PHP 8
- [X] Framework Lumen 8
- [X] Mysql
- [X] Docker

**Rotas para Usuario**
|Métodos| Parâmetros | Descrição |
|---|---|---|
|`GET`| `/api/users` | Retorna um JSON com todos os usuário. |
|`GET`| `/api/user/{id}` | Retorna o usurário usando id do usuario. |
|`POST`| `/api/user` | Efetua o cadastro de um usuário. |
|`PUT`| `/api/user/update/{id}` | Atualiza um usaurio. |
|`DELETE`| `/api/user/delete/{id}` | Deleta o usurário usando id do usuario. |

**Rotas para Carrteira**
|Métodos| Parâmetros | Descrição |
|---|---|---|
|`GET`| `/api/wallets` | Retorna um JSON com todas as carteiras. |
|`GET`| `/api/wallet/{id}` | Retorna a carteira do usuario especifico. |
|`POST`| `/api/transfer` | Realiza uma transferencia entre usuarios. |
|`POST`| `/api/deposit` | Realiza um deposito. |

**Rotas para Trasações**
|Métodos| Parâmetros | Descrição |
|---|---|---|
|`GET`| `/api/transactions` | Retorna um JSON com todas as transações. |
|`GET`| `/api/transactions/{id}` | Retorna as transações do usuário específico. |

> 
