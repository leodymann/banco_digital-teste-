# Banco Digital com Blockchain Simplificada // Digital Banking with Simplified Blockchain

[Pt-Br]
> **"Simulação de BLOCKCHAIN com foco na IMUTABILIDADE das transações."**<br>
[En]
> **"BLOCKCHAIN ​​simulation focusing on the IMMUTABILITY of transactions."**<br>
---

## Info@Informações<br>

**Contact@Contato**<br>

**[Pt-Br]**<br>
    >>> Desenvolvido por **@Leodymann**, atuando como Desenvolvedor **Fullstack**, responsável pela concepção, implementação e integração de todas as camadas deste sistema.<br>
    >>> Email || **ofleodymann@gmail.com**<br>
    >>> Linked In || **linkedin.com/in/leodymann/**<br>
**[En]**<br>
    >>> Developed by **@Leodymann**, acting as **Fullstack** Developer, responsible for the design, implementation and integration of all layers of this system.<br>
    >>> Email || **ofleodymann@gmail.com**<br>
    >>> Linked In || **linkedin.com/in/leodymann/**<br>

---

## Notas de Atualização // Update Notes<br>

**[Pt-Br]**<br>
    Este sistema encontra-se em estágio de desenvolvimento e aprimoramento contínuo. Embora as funcionalidades essenciais estejam implementadas, novas melhorias, correções e recursos adicionais estão previstos para as próximas versões. Recomendamos acompanhar as atualizações futuras, que visam fortalecer ainda mais a segurança, a usabilidade e a eficiência da aplicação.<br>
**[En]**<br>
    This system is currently undergoing continuous development and improvement. Although the essential functionalities have been implemented, new improvements, fixes and additional features are planned for future versions. We recommend that you keep an eye on future updates, which aim to further strengthen the security, usability and efficiency of the application.<br>

---

## Visão Geral // Overview<br>

**[Pt-Br]**<br>
    Este projeto integra um sistema bancário digital com os princípios fundamentais da tecnologia BLOCKCHAIN, garantindo que
    cada transação componha uma cadeia inquebrável, auditável e transaparente.<br>
**[Pt-Br]**<br>
    O sistema permite a realização de operações financeiras essenciais, como transferências e depósitos, com total rastreabilidade. Cada ação executada impacta diretamente a estrutura da cadeia de blocos, assegurando a imutabilidade e a integridade dos dados. Além disso, mecanismos automatizados de validação e reparo garantem a segurança e a consistência do sistema frente a possíveis falhas ou inconsistências.<br>
**[En]**<br>
    This project integrates a digital banking system with the fundamental principles of BLOCKCHAIN ​​technology, ensuring that each transaction forms an unbreakable, auditable and transparent chain.<br>
**[En]**<br>
    The system allows essential financial transactions, such as transfers and deposits, to be carried out with full traceability. Each action performed directly impacts the structure of the blockchain, ensuring the immutability and integrity of data. In addition, automated validation and repair mechanisms ensure the security and consistency of the system in the face of possible failures or inconsistencies.<br>

---

## Principais Funcionalidades // Main Features<br>

**[Pt-Br]**<br>
    - **Transferências** e **depósitos** entre contas.<br>
    - **Extrato** e **saldo** em tempo real.<br>
    - Estrutura de **blocos**, cada um com seu `hash` e `previous hash`.<br>
    - **Verificação de integridade** completa dos blocos.<br>
    - **Reparo automático** de blocos corrompidos.<br>
    - **Acesso restrito** ao painel de integridade para administradores.<br>
    - **Logs** detalhados de todos os reparos.<br>

**[En]**<br>
    - **Transfers** and **deposits** between accounts.<br>
    - **Extract** and **balance** in real time.<br>
    - **Block** structure, each with its `hash` and `previous hash`.<br>
    - **Full block integrity check**.<br>
    - **Automatic repair** of corrupted blocks.<br>
    - **Restricted access** to the integrity panel for administrators.<br>
    - **Detailed logs** of all repairs.<br>

---

## Tecnologias // Technologies<br>

**[Pt-Br]**<br>
    O sistema foi desenvolvido utilizando um conjunto integrado de tecnologias que garantem segurança, desempenho e escalabilidade:<br>
        >>> **Arquitetura MVC** (Modelo-Visualização-Controlador): Padrão de organização do código que separa a aplicação em três camadas distintas — **Modelo** (dados e regras de negócio), **Visualização** (interface com o usuário) e **Controlador** (controle do fluxo da aplicação). Essa estrutura facilita a manutenção, escalabilidade e clareza do projeto.<br>
        >>> **PHP**: Linguagem principal para o desenvolvimento do backend, responsável pela lógica de negócio, manipulação de dados, autenticação, e interação com o banco de dados.<br>
        >>> **MySQL**: Sistema de gerenciamento de banco de dados relacional utilizado para armazenar informações de usuários, transações e blocos, garantindo a persistência e integridade dos dados.<br>
        >>> **PDO** (PHP Data Objects): Interface de acesso ao banco de dados que oferece uma camada segura e eficiente para executar consultas SQL, prevenindo vulnerabilidades como SQL Injection.<br>
        >>> **HTML/CSS**: Tecnologias responsáveis pela estruturação e estilização das páginas web, proporcionando uma interface amigável e responsiva para os usuários.<br>
**[En]**<br>
    The system was developed using an integrated set of technologies that guarantee security, performance and scalability:<br>
        >>> **MVC Architecture** (Model-View-Controller): Code organization pattern that separates the application into three distinct layers — **Model** (data and business rules), **View** (user interface) and **Controller** (application flow control). This structure facilitates maintenance, scalability and project clarity.<br>
        >>> **PHP**: Main language for backend development, responsible for business logic, data manipulation, authentication, and interaction with the database.<br>
        >>> **MySQL**: Relational database management system used to store user, transaction and block information, ensuring data persistence and integrity.<br>
        >>> **PDO** (PHP Data Objects): Database access interface that offers a secure and efficient layer for executing SQL queries, preventing vulnerabilities such as SQL Injection.<br>
        >>> **HTML/CSS**: Technologies responsible for structuring and styling web pages, providing a user-friendly and responsive interface for users.<br>
    
---

## Fluxo do Sistema // System Flow<br>

**[Pt-br]**<br>
    Fluxo do Usuário<br>
        >>> **Login**: Usuário acessa o sistema com suas credenciais.<br>
        >>> **Dashboard**: Visualiza saldo e acessa funcionalidades.<br>
        >>> **Depósito**: Registra valores na conta.<br>
        >>> **Transferência**: Envia fundos para outras contas. (Cada transferência é registrada como uma transação vinculada a um bloco na cadeia.)<br>
        >>> **Extrato**: Consulta histórico de transações e saldo.<br>
        >>> **Painel de Integridade**: Administradores verificam e corrigem a cadeia de blocos.<br>
        >>> **Logout**: Encerra a sessão com segurança.<br>
**[En]**<br>
    User Flow<br>
        >>> **Login**: User accesses the system with their credentials.<br>
        >>> **Dashboard**: Views balance and accesses features.<br>
        >>> **Deposit**: Registers amounts in the account.<br>
        >>> **Transfer**: Sends funds to other accounts. (Each transfer is recorded as a transaction linked to a block in the chain.)<br>
        >>> **Statement**: Consults transaction history and balance.<br>
        >>> **Integrity Panel**: Administrators check and correct the blockchain.<br>
        >>> **Logout**: Closes the session securely.<br>

---

## Imagens // Images<br>

![Dashboard](/bank_proj/images/dashboard.png) // Dashboard Panel
![Extract](/bank_proj/images/extract.png) // Extract Panel
![Transfer](/bank_proj/images/transfer.png) // Transfer Panel
![Deposit](/bank_proj/images/deposit.png) // Deposit Panel
![Balance](/bank_proj/images/balance.png) // Balance Panel
![Blocks](/bank_proj/images/blocks.png) // Blocks Panel

---

## Info@Informações<br>

**Installation@Instalação**<br>

**[Pt-Br]**<br>
    (1) Clone o repositório:<br>
        - git clone https://github.com/seu-usuario/seu-repositorio.git <br>
    (2) Configure o ambiente:<br>
        - Certifique-se de ter PHP (>=7.4), MySQL e um servidor como Apache ou Nginx instalados.<br>
        - Crie um banco de dados MySQL e importe o arquivo database.sql disponível na pasta /database.<br>
    (3) Configure as credenciais:<br>
        - No arquivo models/Database.php, ajuste as informações de conexão (host, dbname, user, password).<br>
    (4)Inicie o servidor:<br>
        - Acesse a pasta do projeto e rode: php -S localhost:8000<br>
        - Ou configure em seu servidor local (XAMPP, Laragon etc.).<br>
    (5) Acesse o sistema:<br>
        - Abra o navegador e acesse: http://localhost:8000/views/login.php <br>
        - Ou crie uma conta ou entre como administrador: O administrador pode acessar as funções de reparo e verificação de integridade da blockchain bancária.<br>
**[En]**<br>
    (1) Clone the repository:<br>
        - git clone https://github.com/your-username/your-repository.git <br>
    (2) Set up the environment: <br>
        - Make sure you have PHP (>=7.4), MySQL, and a server like Apache or Nginx installed.<br>
        - Create a MySQL database and import the database.sql file available in the /database folder.<br>
    (3) Set up the credentials:<br>
        - In the models/Database.php file, adjust the connection information (host, dbname, user, password).<br>
    (4) Start the server:<br>
        - Access the project folder and run: php -S localhost:8000<br>
        - Or set up on your local server (XAMPP, Laragon, etc.).<br>
    (5) Access the system:<br>
        - Open the browser and access: http://localhost:8000/views/login.php <br>
        - Either create an account or log in as an administrator: The administrator can access the repair and integrity verification functions of the banking blockchain.<br>