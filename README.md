# Gerencial Ascendra Cursos

Sistema web para gerenciamento de cursos, alunos e relatórios, desenvolvido em Laravel.

## Links

- [Documentação da API](https://documenter.getpostman.com/view/32693779/2sB2xBCpMR)
- [Apresentação no YouTube](https://www.youtube.com/watch?v=l03f25wY7qg)

## Funcionalidades

- Autenticação de usuários
- CRUD de Cursos (criar, editar, excluir, filtrar, paginação)
- CRUD de Alunos (criar, editar, excluir, filtrar, paginação)
- Relatórios:
  - Quantidade de alunos por curso
  - Listagem de alunos por curso (ordem alfabética)
  - Filtros e itens por página nos relatórios
- Validações e mensagens de erro amigáveis
- Testes automatizados

## Tecnologias

- [Laravel](https://laravel.com/) (backend, Blade)
- [Tailwind CSS](https://tailwindcss.com/) (estilização)
- [Alpine.js](https://alpinejs.dev/) (interatividade)
- [Vite](https://vitejs.dev/) (build frontend)
- [PHPUnit](https://phpunit.de/) (testes)
- [SQLite](https://www.sqlite.org/) (banco de dados)

## Como rodar o projeto

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/GabrielBorgess/Gerencial-AlunosECursos
   cd Gerencial-AlunosECursos
   ```

2. **Instale as dependências:**
   ```bash
   composer install
   npm install
   ```

3. **Configure o ambiente:**
   - Copie `.env.example` para `.env` e ajuste as variáveis de banco de dados.
   - Gere a chave da aplicação:
     ```bash
     php artisan key:generate
     ```

4. **Rode as migrations e seeders:**
   ```bash
   php artisan migrate --seed
   ```

5. **Rode o servidor:**
   ```bash
   php artisan serve
   ```

6. **Rode o build do frontend:**
   ```bash
   npm run dev
   ```

7. **Acesse em:**  
   [http://localhost:8000/register](http://localhost:8000/register)

##  Rodando os testes

```bash
php artisan test
```
