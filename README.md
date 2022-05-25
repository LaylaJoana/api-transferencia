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
|`GET`| `/api/users` | Retorna um JSON com todos os usuários. |
|`GET`| `/api/user/{id}` | Retorna o usuário específico. |
|`POST`| `/api/user` | Realiza o cadastro de um usuário. |
|`PUT`| `/api/user/update/{id}` | Atualiza um usuário específico. |
|`DELETE`| `/api/user/delete/{id}` | Deleta o usuário usuário específico. |

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
