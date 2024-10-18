# 🎯 Desafio FIAP

Este repositório contém o projeto do Desafio da FIAP. Abaixo estão as instruções para rodar o projeto e algumas informações adicionais sobre seu funcionamento.

## ✅ Requisitos para Rodar o Projeto

1. **Instalar o XAMPP**: Durante a instalação, certifique-se de que a opção do MySQL está marcada.
2. **Instalar o Git**: Para clonar o repositório.
3. **Sistema operacional**: Windows.

## 🖥️ Rodando o Projeto

1. **Localizar a pasta do XAMPP**: O caminho de instalação padrão é: `C:\xampp`.

2. **Iniciar o XAMPP**:
   - Entre na pasta do XAMPP e procure por `xampp-control.exe`, e clique para abrir.
   - Clique em **Start** para os serviços **Apache** e **MySQL**.
   - O acesso ao mysql se mantem o padrão que já vem quando é instalado, que é o usuario: root e a senha vazia.

3. **Acessar a pasta `htdocs`**:
   - Na pasta do XAMPP, localize a pasta `htdocs`.
   - Clique com o botão direito do mouse em qualquer parte da pasta `htdocs` e selecione a opção **Open Git Bash Here** para abrir o terminal do Git. 
   - Se não conseguir abrir o Git Bash, abra o Prompt de Comando e navegue até a pasta `htdocs`.

4. **Clonar o repositório**:
   - Com o terminal aberto no diretório `htdocs`, execute o comando:     
     ```bash
     git clone https://github.com/izadora-toledo/desafio-fiap.git
     ```  

5. **Importar o banco de dados**:
   - Volte para o **XAMPP Control** e clique em **Admin** ao lado do botão **Start**.
   - Isso abrirá uma nova aba no navegador com um menu. Procure por **phpMyAdmin** e clique nele.   
   - No `phpMyAdmin`, procure a opção **Importar** no menu.
   - Clique em **Importar**, em seguida clique em **Escolher arquivo** e selecione o arquivo `dump.sql` que se encontra dentro da pasta `config` do projeto.
   - Após escolher o arquivo, role a tela para baixo e clique no botão **Importar**.

6. **Acessar o sistema**:
   - Após a importação, acesse o sistema pelo seguinte endereço:
     ```
     http://localhost/desafio-fiap/views/admin/login/index.php
     ```
   - Utilize as seguintes credenciais para login:
     - **Usuário**: `admin`
     - **Senha**: `fiap@2024`
   - Após logar, você será direcionado para a tela do dashboard.

## 🛠️ Funcionalidades

- Criei cadastros ficticios em todas as tabelas para ficar melhor de testar o projeto, mas fique a vontade em criar usando os passos abaixo.

- **Cadastrar Aluno**:
  - Clique no menu **Alunos** e depois em **Cadastrar Aluno**. Preencha os dados e clique em **Cadastrar**.
  - Para visualizar o aluno recém-criado, volte ao menu **Alunos** e clique em **Listar Alunos**. A paginação está configurada para exibir 5 alunos por vez.

- **Cadastrar Turma**:
  - O funcionamento do menu **Turmas** é idêntico ao de **Alunos**, exceto pela ausência de paginação.

- **Matricular Aluno**:
  - Acesse o menu **Matrículas** e clique em **Cadastrar Aluno em Turma**. Preencha os dados necessários e clique em **Matricular**.
  - Para ver os alunos matriculados em uma turma específica, volte ao menu **Matrículas** e clique em **Listar Matrículas por Turma**. Selecione a turma para visualizar os alunos registrados.

## 📋 Observações

- A autenticação não está completamente implementada, então algumas páginas só estão acessíveis para usuários logados e outras não.
- A paginação foi aplicada apenas na lista do menu **Alunos**.

## 💗 Agradecimentos

Agradeço a oportunidade e estou ansiosa para trabalhar com a Techlead Vanessa e os demais membros da equipe. Estou à disposição para tirar qualquer dúvida. Boa sorte para mim!
