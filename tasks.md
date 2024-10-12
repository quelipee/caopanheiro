# Funcionalidades Essenciais (Backend)

## 1.1. Autenticação de Usuários

- [x] **Registro de Usuários:**
    - [x] Criar endpoint de cadastro de usuários (`POST /register`).
        - Campos: nome, e-mail, senha, telefone, endereço, tipo de usuário (adotante, administrador).

- [x] **Login de Usuários:**
    - [x] Criar endpoint de login (`POST /login`).
        - Geração e gestão de tokens (ex: Laravel Sanctum).

- [x] **Sistema de Logout:**
    - [x] Criar endpoint de logout (`POST /logout`).

## 1.2. Gerenciamento de Animais

- [x] **Cadastro de Animais (Admin):**
    - [x] Criar endpoint para cadastro de novos animais para adoção (`POST /animals`).
        - Campos: nome, espécie, raça, idade, porte, gênero, status, foto, descrição.

- [x] **Listagem de Animais Disponíveis para Adoção:**
    - [x] Criar endpoint para listar todos os animais disponíveis (`GET /animals`).
        - Implementar filtros por espécie, idade, porte, etc.
  
    - [x] **Detalhes de Animais:**
      - [x] Criar endpoint para visualizar detalhes de um animal (`GET /animals/{id}`).
      
    - [ ] **Edição e Remoção de Animais (Admin):**
      - [x] Criar endpoint para editar informações de um animal (`PUT /animals/{id}`).
      - [ ] Criar endpoint para remover um animal do banco de dados (`DELETE /animals/{id}`).

## 1.3. Sistema de Adoção

- [ ] **Iniciar Processo de Adoção:**
  - [ ] Criar endpoint para usuários adotarem um animal (`POST /adoption`).
  - [ ] Associar o usuário e o animal à adoção com status pendente.
  
- [ ] **Finalizar Adoção (Admin):**
  - [ ] Criar endpoint para concluir o processo de adoção (`PUT /adoption/{id}/complete`).
  - [ ] Alterar status do animal para "adotado" e atualizar a relação de adoção.

## 1.4. Sistema de Favoritos

- [ ] **Adicionar Animais aos Favoritos:**
    - [ ] Criar endpoint para que usuários possam adicionar animais aos favoritos (`POST /favorites`).

- [ ] **Visualizar Animais Favoritos:**
    - [ ] Criar endpoint para visualizar animais favoritos de um usuário (`GET /favorites`).

# 2. Funcionalidades do Frontend (Vue.js)

## 2.1. Autenticação

- [ ] **Criar Tela de Login:**
    - [ ] Implementar formulário de login no frontend.
    - [ ] Conectar o formulário ao backend via API para autenticação.

- [ ] **Criar Tela de Registro:**
    - [ ] Criar formulário para cadastro de novos usuários.
    - [ ] Implementar a conexão com o backend para criar o usuário.

## 2.2. Página Inicial (Home)

- [ ] **Mostrar Animais Disponíveis:**
    - [ ] Exibir uma lista de animais disponíveis para adoção na página inicial.
    - [ ] Filtrar animais por espécie (cachorros, gatos) e outras características (idade, porte, etc.).

- [ ] **Botão de Ação: Adotar ou Favoritar:**
    - [ ] Implementar botões de ação para iniciar o processo de adoção ou adicionar aos favoritos.

## 2.3. Listagem e Detalhes de Animais

- [ ] **Página de Detalhes do Animal:**
    - [ ] Implementar uma página que exibe os detalhes completos de um animal ao clicar nele.

## 2.4. Sistema de Favoritos

- [ ] **Página de Favoritos:**
    - [ ] Criar uma página para exibir os animais que o usuário adicionou aos favoritos.

## 2.5. Página de Perfil do Usuário

- [ ] **Histórico de Adoções e Perfil:**
    - [ ] Exibir um histórico de adoções para cada usuário.
    - [ ] Mostrar detalhes do perfil (nome, e-mail, telefone, etc.).

# 3. Funcionalidades de Administração (Somente Admin)

## 3.1. Gerenciamento de Animais

- [ ] **Criar Página de Gerenciamento de Animais:**
    - [ ] Criar uma interface onde administradores podem cadastrar, editar e remover animais do sistema.

## 3.2. Gerenciamento de Adoções

- [ ] **Criar Página de Gerenciamento de Adoções:**
    - [ ] Administradores devem ter uma página onde podem visualizar, aprovar ou recusar pedidos de adoção.

# 4. Integrações Adicionais

## 4.1. Envio de E-mails

- [ ] **Enviar E-mails de Confirmação:**
    - [ ] Implementar envio de e-mails de confirmação após o registro de usuários e finalização de adoções.

## 4.2. Upload de Fotos de Animais

- [ ] **Adicionar Upload de Fotos:**
    - [ ] Implementar upload de imagens de animais no processo de cadastro de novos animais.

## 4.3. Sistema de Notificações

- [ ] **Notificar Usuários sobre Adoções:**
    - [ ] Notificar os usuários por e-mail ou no frontend quando um pedido de adoção for aprovado ou recusado.
