# Brew Product

Gerencie produtos de forma simples e eficiente! Este projeto é uma aplicação web desenvolvida para o desafio prático da Brew, utilizando as melhores práticas de componentização, interatividade e responsividade com Laravel, Livewire, Blade e Tailwind CSS.

---

## Tecnologias

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)
![Php](https://img.shields.io/badge/Php-8.2-purple?logo=Php)
![Livewire](https://img.shields.io/badge/Livewire-3.x-blue?logo=laravel)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38bdf8?logo=tailwindcss)
![Node.js](https://img.shields.io/badge/Node.js-20.x-green?logo=node.js)

---

## Como rodar o projeto

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/Thalesousa/brew-project.git
   cd brew-project
   ```

2. **Instale as dependências do PHP e do Node.js:**
   ```bash
   composer install
   npm install
   ```

3. **Configure o arquivo `.env`:**
   - Copie `.env.example` para `.env` e ajuste as variáveis de ambiente, especialmente as de banco de dados.

4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

5. **Execute as migrations e (opcional) seeders:**
   ```bash
   php artisan migrate
   # php artisan db:seed
   ```

6. **Compile os assets:**
   ```bash
   npm run dev
   ```

7. **Inicie o servidor:**
   ```bash
   php artisan serve
   ```

8. **Acesse a aplicação:**
   - Abra [http://localhost:8000](http://localhost:8000) no navegador.

---

## Funcionalidades obrigatórias implementadas

- **Autenticação:**
  Sistema de login implementado usando autenticação padrão do laravel, sem utilizar starter kits. Apenas usuários autenticados acessam as telas de produtos.

- **CRUD de Produtos:**
  Produtos possuem os campos: Nome, SKU, Imagem (URL), Ativo, Preço, Estoque, Criado por, Criado em,  atualizado em e deletado em.

- **Listagem de produtos:**
  - Busca por Nome ou SKU (Livewire).
  - Ordenação por coluna "nome" ao clicar.
  - Indicação de status Ativo/Inativo.
  - Paginação padrão do Laravel.

- **Criação de produtos:**
  - Formulário simples.
  - Mensagem de feedback de sucesso ou erro (componente Blade e Livewire).

- **Edição de produtos:**
  - Feita via modal (componente Livewire).
  - Mensagem de feedback após atualização.

- **Deleção de produtos:**
  - Confirmação antes de excluir (Livewire).
  - Mensagem de feedback.
  - Possui soft deletes.

---

## Funcionalidades opcionais/diferenciais implementadas

- **Componentização:**
  Uso extensivo de componentes Blade e Livewire para tabela, modal, mensagens e formulários.

- **Responsividade:**
  Layout responsivo com Tailwind CSS.

- **Soft Deletes:**
  Produtos são excluídos usando Soft Deletes.

- **Validação:**
  Todos os formulários possuem validação de campos.

- **UX aprimorada:**
  Modais fluidos, mensagens de feedback automáticas e claras.

- **Livewire:**
  Utilizado para busca, ordenação, modal e atualização dinâmica da tabela.

---
