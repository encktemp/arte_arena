<!-- =======================================================
     Tema Nome: Teste Arte Arena
     Tema URL: https://artearena.com.br
     Autor: Luiz Möeller / Dev FullStack
     Autor URL: https://luizmoeller.lcmwebsites.com.br
======================================================== -->

# Teste Arte Arena
Projeto desenvolvido para teste de desenvolvedor Full Stack...

```markdown
# Arte Arena

Arte Arena é um projeto desenvolvido para demonstrar habilidades em lidar com grandes volumes de dados, integração de APIs, desenvolvimento de backend robusto e interfaces frontend performáticas e responsivas. Este projeto utiliza **Redis**, **MySQL**, **Laravel**, **React**, **Next.js** e **Material-UI (MUI)**.

## **Descrição do Projeto**

### **Arquitetura**
- **Backend**: Desenvolvido em Laravel 11 com banco de dados MySQL para gerenciar dados da API [JSONPlaceholder](https://jsonplaceholder.typicode.com/guide/). Inclui cache Redis para otimizar requisições.
- **Frontend**: Criado com React 18, Next.js, e Material-UI, proporcionando uma interface de usuário responsiva e intuitiva.
- **Sincronização de Dados**: Sincronização diária dos registros da API com o banco de dados por meio de jobs Laravel.
- **Deploy**: Utiliza Kubernetes para gerenciar a infraestrutura e um pipeline CI/CD para automatizar o build, teste e deploy.


## **Instruções de Instalação e Configuração**

### **Pré-requisitos**
Certifique-se de ter instalado:
- Node.js (v16 ou superior)
- Composer
- Docker e Docker Compose
- Kubernetes (kubectl e minikube ou outro cluster)
- Redis
- MySQL

### **Instalação**

#### **Backend**
1. Clone o repositório:
   ```bash
   git clone https://github.com/encktemp/arte_arena.git
   cd arte_arena/backend
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

3. Configure o arquivo `.env`:
   Copie o arquivo `.env.example`:
   ```bash
   cp .env.example .env
   ```

   Edite as variáveis de ambiente para incluir configurações do MySQL e Redis.

4. Gere a chave de aplicação:
   ```bash
   php artisan key:generate
   ```

5. Execute as migrações:
   ```bash
   php artisan migrate
   ```

6. Inicie o servidor:
   ```bash
   php artisan serve
   ```

#### **Frontend**
1. Navegue até o diretório do frontend:
   ```bash
   cd ../frontend
   ```

2. Instale as dependências:
   ```bash
   npm install
   ```

3. Configure o arquivo `.env.local`:
   Crie um arquivo `.env.local` com a URL do backend:
   ```
   NEXT_PUBLIC_API_URL=http://localhost:8000/api
   ```

4. Inicie o servidor:
   ```bash
   npm run dev
   ```

5. Acesse o frontend em:
   ```
   http://localhost:3000
   ```

---

## **Sincronização e Cache**

- Utilize o comando CLI para migrar os dados iniciais da API para o MySQL:
  ```bash
  php artisan migrate:api
  ```

- Um job diário será executado automaticamente para sincronizar novos dados.


## **CI/CD e Kubernetes**

### **Pipeline CI/CD**
O pipeline de CI/CD realiza as seguintes tarefas:
1. Build do backend e frontend.
2. Testes automatizados.
3. Criação e publicação de imagens Docker no Docker Hub.
4. Deploy automatizado no Kubernetes.

### **Configuração do CI/CD**
1. Adicione um arquivo `.github/workflows/ci-cd.yml` no repositório.
2. Configure o Docker Hub para armazenar as imagens criadas.

### **Kubernetes**
Manifestos para deploy no Kubernetes estão localizados no diretório `k8s/`. Eles incluem:
- Deployment para backend e frontend.
- Configuração de serviços e ingressos para expor os aplicativos.
- Configuração de volumes persistentes.

Para aplicar os manifestos:
```bash
kubectl apply -f k8s/
```

## **Testes Automatizados**

### **Backend**
- Inclui testes unitários e de integração para endpoints e jobs.
- Execute os testes com:
  ```bash
  php artisan test
  ```

### **Frontend**
- Testes foram implementados para o componente Autocomplete.
- Execute os testes com:
  ```bash
  npm run test
  ```

## **Contribuição**
Sinta-se à vontade para contribuir com melhorias e novas funcionalidades. Envie seu PR com descrição detalhada.

## **Licença**
O projeto é licenciado sob a licença MIT. Consulte o arquivo [LICENSE](./LICENSE) para mais detalhes.
```

Este arquivo README.md contém todas as informações necessárias para o projeto, desde a instalação até o deploy no Kubernetes e a configuração de CI/CD. Você pode incluir este conteúdo no repositório do GitHub.