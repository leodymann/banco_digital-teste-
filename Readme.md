# Banco Digital com Blockchain Simplificada // Digital Banking with Simplified Blockchain

[Pt-Br]
> **"Simulação de BLOCKCHAIN com foco na IMUTABILIDADE das transações."**
[En]
> **"BLOCKCHAIN ​​simulation focusing on the IMMUTABILITY of transactions."**
---

## Info@Informações

**Contact@Contato**

**[Pt-Br]**
    >>> Desenvolvido por **@Leodymann**, atuando como Desenvolvedor **Fullstack**, responsável pela concepção, implementação e integração de todas as camadas deste sistema.
    >>> Email || **ofleodymann@gmail.com**
    >>> Linked In || **linkedin.com/in/leodymann/**
**[En]**
    >>> Developed by **@Leodymann**, acting as **Fullstack** Developer, responsible for the design, implementation and integration of all layers of this system.
    >>> Email || **ofleodymann@gmail.com**
    >>> Linked In || **linkedin.com/in/leodymann/**

---

## Notas de Atualização // Update Notes

**[Pt-Br]**
    Este sistema encontra-se em estágio de desenvolvimento e aprimoramento contínuo. Embora as funcionalidades essenciais estejam implementadas, novas melhorias, correções e recursos adicionais estão previstos para as próximas versões. Recomendamos acompanhar as atualizações futuras, que visam fortalecer ainda mais a segurança, a usabilidade e a eficiência da aplicação.
**[En]**
    This system is currently undergoing continuous development and improvement. Although the essential functionalities have been implemented, new improvements, fixes and additional features are planned for future versions. We recommend that you keep an eye on future updates, which aim to further strengthen the security, usability and efficiency of the application.

---

## Visão Geral // Overview

**[Pt-Br]**
    Este projeto integra um sistema bancário digital com os princípios fundamentais da tecnologia BLOCKCHAIN, garantindo que
    cada transação componha uma cadeia inquebrável, auditável e transaparente.
**[Pt-Br]**
    O sistema permite a realização de operações financeiras essenciais, como transferências e depósitos, com total rastreabilidade. Cada ação executada impacta diretamente a estrutura da cadeia de blocos, assegurando a imutabilidade e a integridade dos dados. Além disso, mecanismos automatizados de validação e reparo garantem a segurança e a consistência do sistema frente a possíveis falhas ou inconsistências.
**[En]**
    This project integrates a digital banking system with the fundamental principles of BLOCKCHAIN ​​technology, ensuring that each transaction forms an unbreakable, auditable and transparent chain.
**[En]**
    The system allows essential financial transactions, such as transfers and deposits, to be carried out with full traceability. Each action performed directly impacts the structure of the blockchain, ensuring the immutability and integrity of data. In addition, automated validation and repair mechanisms ensure the security and consistency of the system in the face of possible failures or inconsistencies.

---

## Principais Funcionalidades // Main Features

**[Pt-Br]**
    - **Transferências** e **depósitos** entre contas.
    - **Extrato** e **saldo** em tempo real.
    - Estrutura de **blocos**, cada um com seu `hash` e `previous hash`.
    - **Verificação de integridade** completa dos blocos.
    - **Reparo automático** de blocos corrompidos.
    - **Acesso restrito** ao painel de integridade para administradores.
    - **Logs** detalhados de todos os reparos.

**[En]**
    - **Transfers** and **deposits** between accounts.
    - **Extract** and **balance** in real time.
    - **Block** structure, each with its `hash` and `previous hash`.
    - **Full block integrity check**.
    - **Automatic repair** of corrupted blocks.
    - **Restricted access** to the integrity panel for administrators.
    - **Detailed logs** of all repairs.

---

## Tecnologias // Technologies

**[Pt-Br]**
    O sistema foi desenvolvido utilizando um conjunto integrado de tecnologias que garantem segurança, desempenho e escalabilidade:
        >>> **Arquitetura MVC** (Modelo-Visualização-Controlador): Padrão de organização do código que separa a aplicação em três camadas distintas — **Modelo** (dados e regras de negócio), **Visualização** (interface com o usuário) e **Controlador** (controle do fluxo da aplicação). Essa estrutura facilita a manutenção, escalabilidade e clareza do projeto.
        >>> **PHP**: Linguagem principal para o desenvolvimento do backend, responsável pela lógica de negócio, manipulação de dados, autenticação, e interação com o banco de dados.
        >>> **MySQL**: Sistema de gerenciamento de banco de dados relacional utilizado para armazenar informações de usuários, transações e blocos, garantindo a persistência e integridade dos dados.
        >>> **PDO** (PHP Data Objects): Interface de acesso ao banco de dados que oferece uma camada segura e eficiente para executar consultas SQL, prevenindo vulnerabilidades como SQL Injection.
        >>> **HTML/CSS**: Tecnologias responsáveis pela estruturação e estilização das páginas web, proporcionando uma interface amigável e responsiva para os usuários.
**[En]**
    The system was developed using an integrated set of technologies that guarantee security, performance and scalability:
        >>> **MVC Architecture** (Model-View-Controller): Code organization pattern that separates the application into three distinct layers — **Model** (data and business rules), **View** (user interface) and **Controller** (application flow control). This structure facilitates maintenance, scalability and project clarity.
        >>> **PHP**: Main language for backend development, responsible for business logic, data manipulation, authentication, and interaction with the database.
        >>> **MySQL**: Relational database management system used to store user, transaction and block information, ensuring data persistence and integrity.
        >>> **PDO** (PHP Data Objects): Database access interface that offers a secure and efficient layer for executing SQL queries, preventing vulnerabilities such as SQL Injection.
        >>> **HTML/CSS**: Technologies responsible for structuring and styling web pages, providing a user-friendly and responsive interface for users.
    
---

## Fluxo do Sistema // System Flow

**[Pt-br]**
    Fluxo do Usuário
        >>> **Login**: Usuário acessa o sistema com suas credenciais.
        >>> **Dashboard**: Visualiza saldo e acessa funcionalidades.
        >>> **Depósito**: Registra valores na conta.
        >>> **Transferência**: Envia fundos para outras contas. (Cada transferência é registrada como uma transação vinculada a um bloco na cadeia.)
        >>> **Extrato**: Consulta histórico de transações e saldo.
        >>> **Painel de Integridade**: Administradores verificam e corrigem a cadeia de blocos.
        >>> **Logout**: Encerra a sessão com segurança.
**[En]**
    User Flow
        >>> **Login**: User accesses the system with their credentials.
        >>> **Dashboard**: Views balance and accesses features.
        >>> **Deposit**: Registers amounts in the account.
        >>> **Transfer**: Sends funds to other accounts. (Each transfer is recorded as a transaction linked to a block in the chain.)
        >>> **Statement**: Consults transaction history and balance.
        >>> **Integrity Panel**: Administrators check and correct the blockchain.
        >>> **Logout**: Closes the session securely.

---

## Imagens // Images

![Dashboard](/bank_proj/images/dashboard.png) // Dashboard Panel
![Extract](/bank_proj/images/extract.png) // Extract Panel
![Transfer](/bank_proj/images/transfer.png) // Transfer Panel
![Deposit](/bank_proj/images/deposit.png) // Deposit Panel
![Balance](/bank_proj/images/balance.png) // Balance Panel
![Blocks](/bank_proj/images/blocks.png) // Blocks Panel

---

## Info@Informações

**Installation@Instalação**

**[Pt-Br]**
    (1) Clone o repositório:
        - git clone https://github.com/seu-usuario/seu-repositorio.git
    (2) Configure o ambiente:
        - Certifique-se de ter PHP (>=7.4), MySQL e um servidor como Apache ou Nginx instalados.
        - Crie um banco de dados MySQL e importe o arquivo database.sql disponível na pasta /database.
    (3) Configure as credenciais:
        - No arquivo models/Database.php, ajuste as informações de conexão (host, dbname, user, password).
    (4)Inicie o servidor:
        - Acesse a pasta do projeto e rode: php -S localhost:8000
        - Ou configure em seu servidor local (XAMPP, Laragon etc.).
    (5) Acesse o sistema:
        - Abra o navegador e acesse: http://localhost:8000/views/login.php
        - Ou crie uma conta ou entre como administrador: O administrador pode acessar as funções de reparo e verificação de integridade da blockchain bancária.
**[En]**
    (1) Clone the repository:
        - git clone https://github.com/your-username/your-repository.git
    (2) Set up the environment:
        - Make sure you have PHP (>=7.4), MySQL, and a server like Apache or Nginx installed.
        - Create a MySQL database and import the database.sql file available in the /database folder.
    (3) Set up the credentials:
        - In the models/Database.php file, adjust the connection information (host, dbname, user, password).
    (4) Start the server:
        - Access the project folder and run: php -S localhost:8000
        - Or set up on your local server (XAMPP, Laragon, etc.).
    (5) Access the system:
        - Open the browser and access: http://localhost:8000/views/login.php
        - Either create an account or log in as an administrator: The administrator can access the repair and integrity verification functions of the banking blockchain.